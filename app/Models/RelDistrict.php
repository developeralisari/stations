<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelDistrict extends Model
{
    use HasFactory;

    protected $fillable = ["location_id","district_id","status"];

    public function connectLocation()
    {
        return $this->hasOne('App\Models\Location', 'id', 'location_id')->where("status",1);
    }

}
