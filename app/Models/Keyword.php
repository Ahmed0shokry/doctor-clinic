<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Keyword extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'keywords';
    protected $primaryKey = '_id';
    protected $fillable = ['name', 'alias'];
}
