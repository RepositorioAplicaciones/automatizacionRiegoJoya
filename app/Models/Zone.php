<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//El modelo Zones es de Zonas

class Worker extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function results(){
        return $this->hasMany('App\Models\Result');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function roster(){
        return $this->belongsTo('App\Models\Roster');
    }
}
