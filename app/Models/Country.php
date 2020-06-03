<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Country extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'countries';
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

}
