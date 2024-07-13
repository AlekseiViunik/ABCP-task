<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Class NotificationManager
 *
 * This class handles the sending of notifications to clients.
 */
class NotificationManager
{
    /**
     * Sends a notification to a client.
     *
     * @param int $resellerId The ID of the reseller.
     * @param int $clientId The ID of the client.
     * @param string $status The return status.
     * @param int $notificationType The notification type.
     * @param array $templateData The data to be used in the notification template.
     * @param string &$error The error message, if any.
     * @return bool True on success, false on failure.
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
     * Sends the actual message to the service.
     *
     * @param int $resellerId The ID of the reseller.
     * @param int $clientId The ID of the client.
     * @param string $status The return status.
     * @param int $notificationType The notification type.
     * @param array $templateData The data to be used in the notification template.
     * @return bool True on success, false on failure.
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
