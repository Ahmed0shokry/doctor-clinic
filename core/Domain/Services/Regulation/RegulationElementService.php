<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 11/26/19
 * Time: 4:57 PM
 */

namespace AppCore\Domain\Services\Regulation;

use AppCore\Domain\Repository\Regulation\IRegulationElementRepository;

class RegulationElementService
{
    /**
     * @var IRegulationElementRepository
     */
    public $regulationElementRepository;

    /**
     * RegulationElementService constructor.
     * @param IRegulationElementRepository $regulationElementRepository
     */
    public function __construct(IRegulationElementRepository $regulationElementRepository)
    {
        $this->regulationElementRepository = $regulationElementRepository;
    }

}