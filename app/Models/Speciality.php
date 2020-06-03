<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Speciality extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'specialities';
    protected $primaryKey = '_id';
    protected $fillable = ['name'];
}
