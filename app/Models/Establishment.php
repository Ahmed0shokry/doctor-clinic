<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Establishment extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'establishments';
    public static $indexName = 'establishments';
    protected $primaryKey = '_id';
    protected $fillable = [
        'name',
        'biography',
        'section',
        'specialities',
        'phones',
        'keywords',
        'social_contacts',
        'slug',
        'branches'
    ];
    public function country()
    {
        return $this->belongsTo(Country::class, 'branches.*.country._id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

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
            'specialities' => [
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
            'section' => [
            ],
            'social_contacts' => [
            ],
            'branches' => [
            ]
        ];
    }
}
