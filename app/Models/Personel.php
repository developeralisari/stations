<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personel extends Model
{
    use HasFactory;

    protected $fillable = ["sap_id","name","driver_id","phone","email","status"];

    public function connectDriver()
    {
        return $this->hasOne('App\Models\Driver', 'id', 'driver_id');
    }
}
