<?php

namespace AppCore\Domain\Entity\Regulation;


use AppCore\Domain\Entity\Entity;

class RegulationElement extends Entity
{

    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $note;
    /**
     * @var integer
     */
    protected $regulationClassId;
    /**
     * @var boolean
     */
    protected $isAffectAttendance;
    /**
     * @var integer
     */
    protected $affectedType;
    /**
     * @var
     */
    protected $timePerMinutes;
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
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    /**
     * @return int
     */
    public function getRegulationClassId(): int
    {
        return $this->regulationClassId;
    }

    /**
     * @param int $regulationClassId
     */
    public function setRegulationClassId(int $regulationClassId): void
    {
        $this->regulationClassId = $regulationClassId;
    }

    /**
     * @return bool
     */
    public function isAffectAttendance(): bool
    {
        return $this->isAffectAttendance;
    }

    /**
     * @param bool $isAffectAttendance
     */
    public function setIsAffectAttendance(bool $isAffectAttendance): void
    {
        $this->isAffectAttendance = $isAffectAttendance;
    }

    /**
     * @return int
     */
    public function getAffectedType(): int
    {
        return $this->affectedType;
    }

    /**
     * @param int $affectedType
     */
    public function setAffectedType(int $affectedType): void
    {
        $this->affectedType = $affectedType;
    }

    /**
     * @return mixed
     */
    public function getTimePerMinutes()
    {
        return $this->timePerMinutes;
    }

    /**
     * @param mixed $timePerMinutes
     */
    public function setTimePerMinutes($timePerMinutes): void
    {
        $this->timePerMinutes = $timePerMinutes;
    }
}