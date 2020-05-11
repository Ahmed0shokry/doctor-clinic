<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 6:36 PM
 */

namespace AppCore\Domain\Entity;


class Entity
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}