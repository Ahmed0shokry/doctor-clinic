<?php
namespace AppCore\Domain\Entity\Regulation;


use AppCore\Domain\Entity\Entity;

/**
 * Class RegulationClass
 * @package AppCore\Domain\Entity\Regulation
 */
class RegulationClass extends Entity
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var RegulationType
     */
    protected $regulationType;
    /**
     * @var Company
     */
    protected $company;
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
     * @return RegulationType
     */
    public function getRegulationType(): RegulationType
    {
        return $this->regulationType;
    }

    /**
     * @param RegulationType $regulationType
     */
    public function setRegulationTypeId(RegulationType $regulationType): void
    {
        $this->regulationType = $regulationType;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(Company $company): void
    {
        $this->company = $company;
    }
}
