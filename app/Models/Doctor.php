<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Doctor extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'doctors';
    protected $primaryKey = '_id';
    protected $fillable = [
        'name', 'biography', 'specialises', 'phones', 'keywords',
        'country_id', 'city_id', 'slug','facebook', 'email', 'website', 'youtube',
        'twitter', 'instagram'];
}
