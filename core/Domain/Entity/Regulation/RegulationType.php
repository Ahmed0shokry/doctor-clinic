<?php
namespace AppCore\Domain\Entity\Regulation;

use AppCore\Domain\Entity\Entity;

class RegulationType extends Entity
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $isPositiveAffect;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isPositiveAffect(): bool
    {
        return $this->isPositiveAffect;
    }

    /**
     * @param bool $isPositiveAffect
     */
    public function setIsPositiveAffect(bool $isPositiveAffect): void
    {
        $this->isPositiveAffect = $isPositiveAffect;
    }


}
