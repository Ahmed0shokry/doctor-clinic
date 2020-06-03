<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 12/2/19
 * Time: 6:49 PM
 */

namespace AppCore\Helper\EntityMapper;

use AppCore\Helper\relationMapper;

abstract class EntityMapper
{

    public static function transformRecordsToEntities($entityModel, $records, $attributes, $relations) {
        $entities = array();
        //if it is associative then it's a single record
        //if array then it's an array of records
        if(self::isObject($records)) {
            return EntityMapper::transformOneRecord($entityModel, $records, $attributes, $relations);
        }
        foreach($records as $record) {
            array_push($entities, EntityMapper::transformOneRecord($entityModel, $record, $attributes, $relations));
        }
        return $entities;
    }
    private static function isObject($array)
    {
        return self::hasStringKeys($array);
    }
    private static function hasStringKeys(array $array) {
        foreach (array_keys($array) as $key) {
            if(is_string($key)) return true;
        }
        return false;
    }

    // ['regulation_type' => RegulationType::class ]

    protected static function transformOneRecord($entityModel, $record, $attributes, $relations)
    {
        $entity = clone $entityModel;
        foreach ($attributes as $entityAttribute => $recordAttribute) {
            self::setValueToEntityAttribute($record, $recordAttribute, $entityAttribute, $entity);
        }
        self::handleRelations($record, $entity, $relations);

        return $entity;
    }


    /**
     * @param $record
     * @param $recordAttribute
     * @param $entityAttribute
     * @param $entity
     */
    protected static function setValueToEntityAttribute($record, $recordAttribute, $entityAttribute, $entity)
    {
        $setAttributeFunctionName = self::getAttributeSetterFunctionName($entityAttribute);
        if (isset($record[$recordAttribute])) $entity->{$setAttributeFunctionName}($record[$recordAttribute]);
    }

    /**
     * @param $entityAttribute
     * @return string
     */
    protected static function getAttributeSetterFunctionName($entityAttribute): string
    {

        if($entityAttribute === 'is_positive_affect'){
            dd($entityAttribute);
            $name = 'set' . str_replace('_', '', ucwords($entityAttribute, '_'));
        }
        return 'set' . str_replace('_', '', ucwords($entityAttribute, '_'));
    }

    /**
     * @param $record
     * @param $entity
     * @param $relations
     */
    protected static function handleRelations($record, $entity, $relations): void
    {
        if(empty($relations)) return;
            foreach ($relations as $relationNameInDB => $value)
            {
                if(is_string($value))
                {
                    //then this value is a mapper name related to this relation name.
                    $subMapper = relationMapper::getMapperInstance($value);
                    $result = $subMapper::map($record[$relationNameInDB]);
                    $entity->{$relationNameInDB} = $result;
                }
                else {
                    //then value is nested relations (array of relations)
                    foreach ($value as $nestedRelationName => $arrayValue)
                    {
                        $subMapper = relationMapper::getMapperInstance($arrayValue['mapper']);
                        $result = $subMapper::map($record[$nestedRelationName], $arrayValue['relations']);
                        $entity->{$nestedRelationName} = $result;
                    }

                }
            }
    }
}
