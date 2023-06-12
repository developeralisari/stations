<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ["name","status","route_id","city_id"];

    public function connectDistrict()
    {
        return $this->hasOne('App\Models\RelDistrict','district_id','id')->where("status",1);
    }

    public function connectRoute()
    {
        return $this->hasOne('App\Models\Route','id','route_id');
    }
}
