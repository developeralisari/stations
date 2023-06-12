<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = ["name","status","city_id"];


    public function connectDistricts()
    {
        return $this->hasMany('App\Models\District','route_id','id');
    }
}
