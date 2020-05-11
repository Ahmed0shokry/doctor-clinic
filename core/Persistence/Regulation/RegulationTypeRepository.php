<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 11/19/19
 * Time: 4:17 PM
 */

namespace AppCore\Persistence\Regulation;


use App\Models\Regulation\RegulationType;
use AppCore\Domain\Repository\Regulation\IRegulationTypeRepository;

class RegulationTypeRepository implements IRegulationTypeRepository
{
    public function getAll()
    {
        return  RegulationType::all()->toArray();
    }

    public function getById($id)
    {
        return RegulationType::find($id);
    }

    public function save($array)
    {
        return RegulationType::create($array);
    }

    public function delete($id)
    {
        return RegulationType::destroy($id);
    }
}
