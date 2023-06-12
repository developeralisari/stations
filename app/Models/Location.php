<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ["name","city_id","branch_id","shift_id","start_end_time","end_time","link","status"];

    public function connectBranch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }

    public function connectCity()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }

    public function connectShift()
    {
        return $this->hasOne('App\Models\Shift', 'id', 'shift_id');
    }

    //protected $dates = ['start_time','end_time'];

    /*
    protected $casts = [
        'start_time'  => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];
    */

}
