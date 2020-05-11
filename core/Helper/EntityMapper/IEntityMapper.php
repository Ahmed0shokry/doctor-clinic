<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 7:39 PM
 */

namespace AppCore\Helper\EntityMapper;


interface IEntityMapper
{
    public static function map($databaseRecords, $relations = []);
    public static function getAttributes();
}
