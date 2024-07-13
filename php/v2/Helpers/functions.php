<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Translate function
 *
 * @param string $key The translation key.
 * @param array|null $params The parameters for the translation.
 * @param int|null $resellerId Id of a reseller
 * @return string The translated string.
 */
function __(string $key, array|null $params = [], int|null $resellerId = null): string
{
    // fakes the __ method
    $translations = [
        'NewPositionAdded' => 'A new position has been added.',
        'PositionStatusHasChanged' => 'The position status has changed from {FROM} to {TO}.',
        'complaintClientEmailSubject' => 'About your complaint',
        'complaintClientEmailBody' => 'Your complaint status has been updated.'
    ];

    $translatedString = $translations[$key] ?? $key;

    if (!empty($params)) {
        foreach ($params as $paramKey => $paramValue) {
            $translatedString = str_replace("{{$paramKey}}", $paramValue, $translatedString);
        }
    }

    return $translatedString;
}
