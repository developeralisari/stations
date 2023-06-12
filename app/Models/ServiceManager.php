<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceManager extends Model
{
    use HasFactory;
    protected $table = "service_managers";
    protected $fillable = ["name","phone","branch_id"];

}
