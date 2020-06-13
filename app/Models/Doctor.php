<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Doctor extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'doctors';
    public static $indexName = 'doctors';
    protected $primaryKey = '_id';
    protected $fillable = [
        'name', 'biography', 'specialises', 'phones', 'keywords',
        'country_id', 'city_id', 'slug','facebook', 'email', 'website', 'youtube',
        'twitter', 'instagram'];

    public static function getMappingProperties(){
        return [
            'name' => [
                'type' => 'text',
                'analyzer' => 'standard'
            ],
            'biography' => [
                'type' => 'text',
                'analyzer' => 'standard'
            ],
            'specialises' => [
                'type' => 'keyword',
            ],
             'phones' => [
                //'type' => 'double',
            ],
            'keywords' => [
            'type' => 'keyword',
            ],
            'country_id' => [
                'type' => 'text',
            ],
            'city_id'  => [
                'type' => 'text',
            ],
            'slug'  => [
                'type' => 'text',
            ],
            'facebook'  => [
                'type' => 'text',
            ],
            'email'  => [
                'type' => 'text',
            ],
            'website'  => [
                'type' => 'text',
            ],
            'youtube' => [
                'type' => 'text',
            ],
            'twitter'  => [
                'type' => 'text',
            ],
            'instagram' => [
                'type' => 'text',
            ]
        ];
    }
}
