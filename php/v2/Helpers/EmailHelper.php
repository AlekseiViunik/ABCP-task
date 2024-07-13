<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Класс EmailHelper
 */
class EmailHelper
{
    /**
     * Получить адрес электронной почты посредника.
     *
     * @param int $resellerId
     * @return string
     */
    public static function getResellerEmailFrom(int $resellerId): string
    {
        return 'contractor@example.com';
    }

    /**
     * Получить адреса электронной почты работников.
     *
     * @param int $resellerId Id посредника.
     * @param string $event Событие.
     * @return array
     */
    public static function getEmailsByPermit(int $resellerId, string $event): array
    {
        // fakes the method
        return ['someemeil@example.com', 'someemeil2@example.com'];
    }

    /**
     * Отправить сообщение, используя определенные параметры.
     *
     * @param array $message Детали сообщения, включая emailFrom, emailTo, subject, and body.
     * @param int $resellerId Id посредника.
     * @param string $status Статус уведомления.
     * @param int|null $clientId Id клиента (optional).
     * @param int|null $notificationType Тип уведомления (optional).
     * @return void
     */
    public static function sendMessage(
        array $message,
        int $resellerId,
        string $status,
        int $clientId = null,
        int $notificationType = null
    ): void {
        // add logic here
    }
}
