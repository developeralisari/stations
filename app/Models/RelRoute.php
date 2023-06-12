<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelRoute extends Model
{
    use HasFactory;

    protected $fillable = ["location_id","route_id","status"];
}
