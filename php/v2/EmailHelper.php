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
     * @return string
     */
    public static function getResellerEmailFrom(): string
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
}
