<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/7/19
 * Time: 3:54 PM
 */

namespace AppCore\Helper;


use AppCore\Helper\EntityMapper\RegulationTypeMapper;

abstract class relationMapper
{
    public static function getMapperInstance($relationName) {
        switch ($relationName) {
            case 'regulationType' : return new RegulationTypeMapper();
        }
    }
}
