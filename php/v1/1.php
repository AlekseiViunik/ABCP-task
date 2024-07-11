<?php

namespace Manager;

use Exception;
use InvalidArgumentException;

class User
{
    public const LIMIT = 10;

    /**
     * Возвращает пользователей старше заданного возраста.
     * @param int $ageFrom
     * @return array
     */
    public function getUsers(int $ageFrom): array
    {
        return \Gateway\User::getUsers($ageFrom);
    }

    /**
     * Возвращает пользователей по списку имен.
     * @param array $names
     * @return array
     */
    public function getByNames(array $names): array
    {
        return array_map(function ($name) {
            return \Gateway\User::user($name);
        }, $names);
    }

    /**
     * Добавляет пользователей в базу данных.
     * @param array $users
     * @return array
     * @throws Exception
     */
    public function addUsersToDataBase(array $users): array
    {
        $ids = [];
        $gateway = \Gateway\User::getInstance();
        $gateway->beginTransaction();
        try {
            foreach ($users as $user) {
                $this->validateUser($user);
                \Gateway\User::add($user['name'], $user['lastName'], $user['age']);
                $ids[] = $gateway->lastInsertId();
            }
            $gateway->commit();
        } catch (Exception $e) {
            $gateway->rollBack();
            throw $e;
        }
        return $ids;
    }

    private function validateUser(array $user): void
    {
        if (!isset($user['name']) || !is_string($user['name']))
        {
            throw new InvalidArgumentException('The "name" field is required and must be a string.');
        }

        if (!isset($user['lastName']) || !is_string($user['lastName']))
        {
            throw new InvalidArgumentException('The "lastName" field is required and must be a string.');
        }

        if (!isset($user['age']) || !is_int($user['age']))
        {
            throw new InvalidArgumentException('The "age" field is required and must be an int.');
        }
    }
}
