<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 5:06 PM
 */

namespace AppCore\Persistence;


use AppCore\Domain\Repository\IRepository;

class AbstractRepository implements IRepository
{
    protected $model;

    /**
     * AbstractRepository constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }


    public function getAll()
    {
        return $this->model->get()->toArray();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function save($array)
    {
        return $this->model->create($array);
    }

    public function update($array, $id)
    {
        return $this->model->where('id', $id)->update($array);
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function deleteAll($ids)
    {
        return $this->model->destroy($ids);
    }

}
