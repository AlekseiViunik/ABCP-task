<?php

namespace Gateway;

use PDO;

class User
{
    /**
     * @var PDO
     */
    public static PDO $instance;

    /**
     * Приватный конструктор для предотвращения создания экземпляров извне.
     */
    private function __construct()
    {
    }

    /**
     * Реализация singleton
     * @return PDO
     */
    public static function getInstance(): PDO
    {

        if (is_null(self::$instance)) {
            $dsn = getenv('DB_DSN');
            $user = getenv('DB_USER');
            $password = getenv('DB_PASSWORD');
            self::$instance = new PDO($dsn, $user, $password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }

    /**
     * Возвращает список пользователей старше заданного возраста.
     * @param int $ageFrom
     * @return array
     */
    public static function getUsers(int $ageFrom): array
    {
        $stmt = self::getInstance()->prepare("
            SELECT id, name, lastName, `from`, age, settings
            FROM Users 
            WHERE age > :ageFrom
            LIMIT :limit");
        $stmt->bindParam(':ageFrom', $ageFrom, PDO::PARAM_INT);
        $limit = \Manager\User::LIMIT;
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($rows as $row) {
            $settings = json_decode($row['settings'], true);
            $users[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'lastName' => $row['lastName'],
                'from' => $row['from'],
                'age' => $row['age'],
                'key' => $settings['key'] ?? null,
            ];
        }

        return $users;
    }

    /**
     * Возвращает пользователя по имени.
     * @param string $name
     * @return array
     */
    public static function user(string $name): array
    {
        $stmt = self::getInstance()->prepare("
            SELECT id, name, lastName, `from`, age, settings 
            FROM Users 
            WHERE name = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $user_by_name = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'id' => $user_by_name['id'],
            'name' => $user_by_name['name'],
            'lastName' => $user_by_name['lastName'],
            'from' => $user_by_name['from'],
            'age' => $user_by_name['age'],
        ];
    }

    /**
     * Добавляет пользователя в базу данных.
     * @param string $name
     * @param string $lastName
     * @param int $age
     * @return string
     */
    public static function add(string $name, string $lastName, int $age): string
    {
        $sth = self::getInstance()->prepare("INSERT INTO Users (name, lastName, age) VALUES (:name, :lastName, :age)");
        $sth->execute([':name' => $name, ':age' => $age, ':lastName' => $lastName]);

        return self::getInstance()->lastInsertId();
    }
}
