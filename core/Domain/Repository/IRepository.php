<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 11/19/19
 * Time: 3:36 PM
 */

namespace AppCore\Domain\Repository;


Interface IRepository
{
    public function getAll();
    public function getById($id);
    public function save($array);
    public function update($array, $id);
    public function delete($id);
    public function deleteAll($ids);
}
