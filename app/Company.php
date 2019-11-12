<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'companies';
    protected $guarded = []; //nothing is guarded, so all are fillable
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
}
