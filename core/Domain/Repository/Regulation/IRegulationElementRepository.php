<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 11/26/19
 * Time: 4:27 PM
 */

namespace AppCore\Domain\Repository\Regulation;


interface IRegulationElementRepository extends IRepository
{
    public function saveWithAffectionDegrees($element, $affectionDegrees);
}