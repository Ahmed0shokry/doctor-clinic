<?php

namespace AppCore\Domain\Entity\Regulation;


use AppCore\Domain\Entity\Entity;

class AffectionDegree extends Entity
{

    /**
     * @var integer
     */
    protected $regulationElementId;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var float
     */
    protected $valuePerDay;

    /**
     * @var string
     */
    protected $notes;

    /**
     * @return int
     */
    public function getRegulationElementId(): int
    {
        return $this->regulationElementId;
    }

    /**
     * @param int $regulationElementId
     */
    public function setRegulationElementId(int $regulationElementId): void
    {
        $this->regulationElementId = $regulationElementId;
    }

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
     * @return float
     */
    public function getValuePerDay(): float
    {
        return $this->valuePerDay;
    }

    /**
     * @param float $valuePerDay
     */
    public function setValuePerDay(float $valuePerDay): void
    {
        $this->valuePerDay = $valuePerDay;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}