<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ["name","city_id","status"];


    public function connectCity()
    {
        return $this->hasOne('App\Models\City','id','city_id');
    }

    public function connectServiceManager()
    {
        return $this->hasOne('App\Models\ServiceManager', 'branch_id', 'id');
    }
}
