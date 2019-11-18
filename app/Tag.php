<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $guarded = []; //nothing is guarded, so all are fillable
    public function employees()
    {
        return $this->morphedByMany(Employee::class, 'taggable');
    }

    public function companies()
    {
        return $this->morphedByMany(Company::class, 'taggable');
    }
}
