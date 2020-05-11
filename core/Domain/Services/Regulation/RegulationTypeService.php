<?php

namespace AppCore\Domain\Services\Regulation;

use AppCore\Domain\Repository\Regulation\IRegulationTypeRepository;

class RegulationTypeService
{
    /**
     * @var IRegulationTypeRepository
     */
    public $regulationTypeRepository;

    /**
     * RegulationService constructor.
     * @param IRegulationTypeRepository $regulationTypeRepository
     */
    public function __construct(IRegulationTypeRepository $regulationTypeRepository)
    {

        $this->regulationTypeRepository = $regulationTypeRepository;
    }

    /**
     *
     *
     * @param AppCore\Domain\Entity\Regulation\RegulationType $user
     * @return bool
     *
     * @throws UserNotFound
     * @throws UserBlockedException
     *
     */
//    public function applyRegulation(AppCore\Domain\Entity\Regulation\RegulationType $user){
//
//
//        if($user->isBlocked){
//            throw new UserBlokcedException($message = '');
//        }
//
//        return true;
//    }
}