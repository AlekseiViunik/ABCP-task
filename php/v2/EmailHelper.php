<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Class EmailHelper
 */
class EmailHelper
{
    /**
     * Get the email address of the reseller.
     *
     * @param int $resellerId
     * @return string
     */
    public static function getResellerEmailFrom(int $resellerId): string
    {
        return 'contractor@example.com';
    }

    /**
     * Get emails of employees
     *
     * @param int $resellerId
     * @param string $event
     * @return array
     */
    public static function getEmailsByPermit(int $resellerId, string $event): array
    {
        // fakes the method
        return ['someemeil@example.com', 'someemeil2@example.com'];
    }

    /**
     * Sends a message using the specified parameters.
     *
     * @param array $message The message details, including emailFrom, emailTo, subject, and body.
     * @param int $resellerId The ID of the reseller.
     * @param string $status The status of the notification event.
     * @param int|null $clientId The ID of the client (optional).
     * @param int|null $notificationType The type of notification (optional).
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
