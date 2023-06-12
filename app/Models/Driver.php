<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ["name","phone","plate","city_id","location_id","status"];

    public function connectLocation()
    {
        return $this->hasOne('App\Models\Location', 'id', 'location_id');
    }
}
