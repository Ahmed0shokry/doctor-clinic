<?php

namespace AppCore\App\Service;

use AppCore\Domain\Repository\Regulation\IRegulationClassRepository;
use AppCore\Helper\EntityMapper\RegulationClassMapper;

class DoctorService implements IAppService
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
