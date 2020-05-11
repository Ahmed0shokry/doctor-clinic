<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 7:34 PM
 */

namespace AppCore\Helper\EntityMapper;


use AppCore\Domain\Entity\Regulation\RegulationClass;

class RegulationClassMapper extends EntityMapper implements IEntityMapper
{
    public static function map($dbRecords, $relations = []){
        return parent::transformRecordsToEntities(new RegulationClass(), $dbRecords, self::getAttributes(), $relations);
    }

//
//    /**
//     * @param array $dbRecords ['id' => '1', 'mame' =>  'aaa', 'reglation_type_id' => '5']
//     * @param array $relationMap ['reglation_type' => reglationTypeMapper::class, '' =>  '', '' => ''
//     */
//    public static function mapWithRelation($dbRecords, array $relationMap){
////          = self::map($dbRecords);
//        foreach ($dbRecords as $record){
//
//            foreach($relationMap as $key => $relationMapper){
//                $dbRecords[$key] = $relationMapper::map($record['regulationType']);
//            }
//        }
//        return
//    }

    public static function getAttributes()
    {
        return [
            'id' => 'id',
            'name' => 'name'
        ];
    }
}
