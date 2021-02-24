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
            'gender' => [
                'type' => 'keyword',
            ],
            'biography' => [
                'type' => 'text',
                'analyzer' => 'standard'
            ],
            'specialities' => [
                'type' => 'keyword',
            ],
            'keywords' => [
                'type' => 'keyword',
            ],
            'slug'  => [
                'type' => 'text',
            ],
            'section' => [
            ],
            'social_contacts' => [
            ],
//            'branches' => [
//                    'type' => 'nested',
//                    'properties' => [
//                        //'phones' => [],
//                        //'price' => '',
//                        'country' => [
//                            'type' => 'nested',
//                            'properties' => [
//                                'id' => [
//                                    'type' => 'keyword',
//                                ],
//                                'name' => [
//                                    'type' => 'keyword',
//                                ],
//                            ]
//                        ],
//                        'city' => [
//                            'type' => 'nested',
//                            'properties' => [
//                                'id' => [
//                                    'type' => 'keyword',
//                                ],
//                                'name' => [
//                                    'type' => 'keyword',
//                                ],
//                            ]
//                        ],
//                        'area' => [
//                            'type' => 'nested',
//                            'properties' => [
//                                'id' => [
//                                    'type' => 'keyword',
//                                ],
//                                'name' => [
//                                    'type' => 'keyword',
//                                ],
//                            ]
//                        ],
//                        //'address' => '',
//                        //'latitude' => '',
//                        //'longitude' => '',
//                        //'appointments' => [],
//                    ]
//                ]
        ];
    }
}
