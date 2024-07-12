<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Class ReferencesOperation
 */
abstract class ReferencesOperation
{
    /**
     * Execute the operation.
     *
     * @return array
     */
    abstract public function doOperation(): array;

    /**
     * Get a request parameter by name.
     *
     * @param string $parameterName
     * @return mixed
     */
    public function getRequest($parameterName): mixed
    {
        return $_REQUEST[$parameterName];
    }
}
