<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Area extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'areas';
    protected $primaryKey = '_id';
    protected $fillable = ['name', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
