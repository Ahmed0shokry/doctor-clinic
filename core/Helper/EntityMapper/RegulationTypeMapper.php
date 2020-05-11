<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/7/19
 * Time: 3:56 PM
 */

namespace AppCore\Helper\EntityMapper;


use AppCore\Domain\Entity\Regulation\RegulationType;

class RegulationTypeMapper extends EntityMapper implements IEntityMapper
{

    public static function map($databaseRecords, $relations = [])
    {
        return parent::transformRecordsToEntities(new RegulationType(), $databaseRecords, self::getAttributes(), $relations);
    }

    public static function getAttributes()
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'isPositiveAffect' => 'is_positive_affect'
        ];
    }
}
