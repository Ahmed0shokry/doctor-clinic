<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 5:47 PM
 */

namespace AppCore\App\Service\Regulation;

use AppCore\App\Service\IAppService;
use AppCore\Domain\Repository\Regulation\IRegulationClassRepository;
use AppCore\Helper\EntityMapper\RegulationClassMapper;

class RegulationClassService implements IAppService
{

    /**
     * @var IRegulationClassRepository
     */
    private $repository;

    /**
     * RegulationClassService constructor.
     * @param IRegulationClassRepository $repository
     */
    public function __construct(IRegulationClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        //dd($this->repository->getAllWithRelation('regulationType'));
        return RegulationClassMapper::map($this->repository->getAllWithRelation('regulationType'),
            ['regulation_type' => 'regulationType']);
        //dd($this->repository->getAll());
        //return RegulationClassMapper::map($this->repository->getById(1));
//        return RegulationClassMapper::map($this->repository->getAll());
    }

    public function store($entity)
    {
        return $this->repository->save($entity);
    }

    public function update($entity, $id)
    {
        return $this->repository->update($entity, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }


}
