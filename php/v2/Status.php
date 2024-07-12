<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * Class Status
 */
class Status
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Get the name of the status by ID.
     *
     * @param int $id
     * @return string
     */
    public static function getName(int $id): string
    {
        $a = [
            0 => 'Completed',
            1 => 'Pending',
            2 => 'Rejected',
        ];

        return $a[$id];
    }
}
