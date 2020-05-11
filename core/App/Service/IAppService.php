<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 5:47 PM
 */

namespace AppCore\App\Service;


interface IAppService
{
    public function index();
    public function store($entity);
    public function update($entity, $id);
    public function delete($id);
}
