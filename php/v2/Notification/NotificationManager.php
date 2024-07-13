<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Класс NotificationManager
 *
 * Класс обрабатывает отправку уведомлений.
 */
class NotificationManager
{
    /**
     * Отправляет уведомление клиентам.
     *
     * @param int $resellerId Id посредника.
     * @param int $clientId Id клиента.
     * @param string $status статус.
     * @param int $notificationType Тип уведомления.
     * @param array $templateData Данные для использования в шаблоне уведомления.
     * @param string &$error Сообщение об ошибке.
     * @return bool True в случае успеха, false, если ошибка.
     */
    public static function send(
        int $resellerId,
        int $clientId,
        string $status,
        int $notificationType,
        array $templateData,
        string &$error
    ): bool {
        $result = self::sendMessageToService($resellerId, $clientId, $status, $notificationType, $templateData);
        if (!$result) {
            $error = 'Failed to send the notification.';
            return false;
        }
        return true;
    }

    /**
     * Отправляет сообщение.
     *
     * @param int $resellerId Id посредника.
     * @param int $clientId Id клиента.
     * @param string $status статус.
     * @param int $notificationType Тип уведомления.
     * @param array $templateData Данные для использования в шаблоне уведомления.
     * @return bool True в случае успеха, false, если ошибка.
     */
    private static function sendMessageToService(
        int $resellerId,
        int $clientId,
        string $status,
        int $notificationType,
        array $templateData
    ): bool {
        return true; // fakes the sendMessageToService method
    }
}
