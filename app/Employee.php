<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

    protected $guarded = []; //nothing is guarded, so all are fillable

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
