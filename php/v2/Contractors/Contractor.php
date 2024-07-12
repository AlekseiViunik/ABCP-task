<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Class Contractor
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

    public static function getById(int $resellerId): self
    {
        return new self($resellerId); // fakes the getById method
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->id;
    }
}