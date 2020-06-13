<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Country extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'countries';
    public static $indexName = 'countries';
    protected $primaryKey = '_id';
    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function establishments()
    {
        return $this->hasMany(Establishment::class, 'branches.country._id', '_id');
    }

    public static function getMappingProperties(){
        return [
            'name' => [
                'type' => 'text',
                'analyzer' => 'standard'
            ]
        ];
    }
}
