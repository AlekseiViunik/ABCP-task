<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Класс Contractor
 *
 * @property Seller $Seller
 */
class Contractor
{
    public const TYPE_CUSTOMER = 0;

    /**
     * @var int
     */
    public int $id;

    /**
     * @var int
     */
    public int $type;

    /**
     * @var string
     */
    public string $name;

    public function __construct(int $id, int $type = self::TYPE_CUSTOMER, string $name = '')
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * Получить подрядчика по id
     *
     * @param int $resellerId
     * @return self
     */
    public static function getById(int $resellerId): self
    {
        return new self($resellerId); // fakes the getById method
    }

    /**
     * Получить полное имя подрядчика
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->name . ' ' . $this->id;
    }
}
