<?php

namespace NW\WebService\References\Operations\Notification;

use Exception;

/**
 * Class TsReturnOperation
 */
class TsReturnOperation extends ReferencesOperation
{
    public const TYPE_NEW    = 1;
    public const TYPE_CHANGE = 2;
    public const EVENT = 'tsGoodsReturn';

    /**
     * Execute the operation.
     *
     * @return array
     * @throws Exception
     */
    public function doOperation(): array
    {
        $data = (array)$this->getRequest('data');
        if (!$data) {
            throw new Exception('No data provided', 400);
        }
        $resellerId = (int)$data['resellerId'];
        $notificationType = (int)$data['notificationType'];
        $result = [
            'notificationEmployeeByEmail' => false,
            'notificationClientByEmail'   => false,
            'notificationClientBySms'     => [
                'isSent'  => false,
                'message' => '',
            ],
        ];

        if (!$resellerId) {
            $result['notificationClientBySms']['message'] = 'Empty resellerId';
            return $result;
        }

        if (!$notificationType) {
            throw new Exception('Empty notificationType', 400);
        }

        $reseller = Seller::getById($resellerId);
        if (!$reseller) {
            throw new Exception('Seller not found!', 400);
        }

        $client = Contractor::getById((int)$data['clientId']);
        if (!$client || $client->type !== Contractor::TYPE_CUSTOMER || $client->Seller->id !== $resellerId) {
            throw new Exception('client not found!', 400);
        }

        $clientFullName = $client->getFullName();
        if (!$client->getFullName()) {
            $clientFullName = $client->name;
        }

        $creator = Employee::getById((int)$data['creatorId']);
        if (!$creator) {
            throw new Exception('Creator not found!', 400);
        }

        $expert = Employee::getById((int)$data['expertId']);
        if (!$expert) {
            throw new Exception('Expert not found!', 400);
        }

        $differences = '';
        if ($notificationType === self::TYPE_NEW) {
            $differences = __('NewPositionAdded', null, $resellerId);
        } elseif ($notificationType === self::TYPE_CHANGE && !empty($data['differences'])) {
            $differences = __('PositionStatusHasChanged', [
                    'FROM' => Status::getName((int)$data['differences']['from']),
                    'TO'   => Status::getName((int)$data['differences']['to']),
                ], $resellerId);
        }

        $templateData = [
            'COMPLAINT_ID'       => (int)$data['complaintId'],
            'COMPLAINT_NUMBER'   => (string)$data['complaintNumber'],
            'CREATOR_ID'         => (int)$data['creatorId'],
            'CREATOR_NAME'       => $creator->getFullName(),
            'EXPERT_ID'          => (int)$data['expertId'],
            'EXPERT_NAME'        => $expert->getFullName(),
            'CLIENT_ID'          => (int)$data['clientId'],
            'CLIENT_NAME'        => $clientFullName,
            'CONSUMPTION_ID'     => (int)$data['consumptionId'],
            'CONSUMPTION_NUMBER' => (string)$data['consumptionNumber'],
            'AGREEMENT_NUMBER'   => (string)$data['agreementNumber'],
            'DATE'               => (string)$data['date'],
            'DIFFERENCES'        => $differences,
        ];

        // Если хоть одна переменная для шаблона не задана, то не отправляем уведомления
        foreach ($templateData as $key => $tempData) {
            if (!$tempData) {
                throw new Exception("Template Data ($key) is empty!", 500);
            }
        }

        $emailFrom = EmailHelper::getResellerEmailFrom($resellerId);
        // Получаем email сотрудников из настроек
        $emails = EmailHelper::getEmailsByPermit($resellerId, self::EVENT);
        if (!empty($emailFrom) && count($emails) > 0) {
            foreach ($emails as $email) {
                MessagesClient::sendMessage([
                    0 => [ // MessageTypes::EMAIL
                           'emailFrom' => $emailFrom,
                           'emailTo'   => $email,
                           'subject'   => __('complaintEmployeeEmailSubject', $templateData, $resellerId),
                           'message'   => __('complaintEmployeeEmailBody', $templateData, $resellerId),
                    ],
                ], $resellerId, NotificationEvents::CHANGE_RETURN_STATUS);
                $result['notificationEmployeeByEmail'] = true;
            }
        }

        // Шлём клиентское уведомление, только если произошла смена статуса
        if ($notificationType === self::TYPE_CHANGE && !empty($data['differences']['to'])) {
            if (!empty($emailFrom) && !empty($client->email)) {
                MessagesClient::sendMessage([
                    0 => [ // MessageTypes::EMAIL
                           'emailFrom' => $emailFrom,
                           'emailTo'   => $client->email,
                           'subject'   => __('complaintClientEmailSubject', $templateData, $resellerId),
                           'message'   => __('complaintClientEmailBody', $templateData, $resellerId),
                    ],
                ], $resellerId, $client->id, NotificationEvents::CHANGE_RETURN_STATUS, (int)$data['differences']['to']);
                $result['notificationClientByEmail'] = true;
            }

            if (!empty($client->mobile)) {
                $res = NotificationManager::send(
                    $resellerId,
                    $client->id,
                    NotificationEvents::CHANGE_RETURN_STATUS,
                    (int)$data['differences']['to'],
                    $templateData,
                    $error
                );
                if ($res) {
                    $result['notificationClientBySms']['isSent'] = true;
                }
                if (!empty($error)) {
                    $result['notificationClientBySms']['message'] = $error;
                }
            }
        }

        return $result;
    }
}
