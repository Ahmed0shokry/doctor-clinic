<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Speciality extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'specialities';
    public static $indexName = 'specialities';
    protected $primaryKey = '_id';
    protected $fillable = ['name', 'alias'];

    public static function getMappingProperties(){
        return [
            'name' => [
                'type' => 'keyword',
            ],
            'alias' => [
                'type' => 'keyword',
            ]
        ];
    }
}
