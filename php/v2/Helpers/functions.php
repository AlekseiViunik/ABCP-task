<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Интернационализация текста
 *
 * @param string $key Ключ для перевода.
 * @param array|null $params Параметры перевода.
 * @param int|null $resellerId Id посредника
 * @return string Переведенная строка.
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
