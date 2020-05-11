<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 5:00 PM
 */

namespace AppCore\Persistence\Regulation;


use App\Models\Regulation\RegulationClass;
use AppCore\Domain\Repository\Regulation\IRegulationClassRepository;
use AppCore\Persistence\AbstractRepository;

class RegulationClassRepository extends AbstractRepository implements IRegulationClassRepository
{

    /**
     * RegulationClassRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new RegulationClass());
    }
    //todo refine
    public function getAllWithRelation($relation)
    {
        return $this->model->with($relation)->get()->toArray();
    }

}
