<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Section extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'sections';
    public static $indexName = 'sections';
    protected $primaryKey = '_id';
    protected $fillable = ['name', 'alias'];
    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }

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
