<?php

namespace NW\WebService\References\Operations\Notification;

function getResellerEmailFrom(): string
{
    return 'contractor@example.com';
}

function getEmailsByPermit(int $resellerId, string $event): array
{
    // fakes the method
    return ['someemeil@example.com', 'someemeil2@example.com'];
}