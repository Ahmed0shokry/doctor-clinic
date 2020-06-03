<?php

namespace App\Models;

use App\Search\Searchable;
use Jenssegers\Mongodb\Eloquent\Model;

class Establishment extends Model
{
    use Searchable;

    protected $connection = 'mongodb';
    protected $collection = 'establishments';
    protected $primaryKey = '_id';
    protected $fillable = ['name', 'biography', 'section', 'specialises', 'phones', 'keywords', 'social_contacts', 'slug', 'branches'];
    public function country()
    {
        return $this->belongsTo(Country::class, 'branches.*.country._id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function mapping() {

    }


}
