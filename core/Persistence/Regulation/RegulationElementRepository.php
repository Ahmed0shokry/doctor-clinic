<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 11/26/19
 * Time: 4:31 PM
 */

namespace AppCore\Persistence\Regulation;


use App\Models\Regulation\RegulationElement;
use AppCore\Domain\Repository\Regulation\IRegulationElementRepository;
use DB;

/**
 * Class RegulationElementRepository
 * @package AppCore\Persistence\Regulation
 */
class RegulationElementRepository extends AbstractRepository implements IRegulationElementRepository
{


    /**
     * @var RegulationElement
     */
    private $regulationElementModel;

    /**
     * RegulationElementRepository constructor.
     * @param RegulationElement $regulationElementModel
     */
    public function __construct(RegulationElement $regulationElementModel)
    {
        $this->regulationElementModel = $regulationElementModel;
    }


    public function getAll()
    {
        return $this->regulationElementModel->all();
    }

    public function getById($id)
    {
        return $this->regulationElementModel->find($id);
    }

    public function save($array)
    {
        return $this->regulationElementModel->create($array);
    }

    public function delete($id)
    {
        return $this->regulationElementModel->destroy($id);
    }

    public function saveWithAffectionDegrees($element, $affectionDegrees)
    {
        return $this->save($elment)->affctionDgrees()->saveMany($affectionDegrees);
    }


}