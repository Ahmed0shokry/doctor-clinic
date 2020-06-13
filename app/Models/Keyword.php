<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Keyword extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'keywords';
    public static $indexName = 'keywords';
    protected $primaryKey = '_id';
    protected $fillable = ['name', 'alias'];

    public static function getMappingProperties(){
        return [
            'name' => [
                'type' => 'keyword',
            ],
            'alias' => [
                'type' => 'keyword',
            ],
        ];
    }
}
