<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 4:48 PM
 */

namespace AppCore\Domain\Repository\Regulation;

use AppCore\Domain\Repository\IRepository;

interface IRegulationClassRepository extends IRepository
{
    public function getAllWithRelation($relation);
}
