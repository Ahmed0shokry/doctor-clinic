<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class City extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'cities';
    public static $indexName = 'cities';
    protected $primaryKey = '_id';
    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public static function getMappingProperties(){
        return [
            'name' => [
                'type' => 'text',
                'analyzer' => 'standard'
            ],
            'country_id' => [
                'type' => 'text',
            ]
        ];
    }
}
