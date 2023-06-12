<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CspHRJob extends Model
{
    use HasFactory;

    protected $connection = 'automatic_works';

    protected $table = 'CSP_HR_PERSONEL_LIST';

    public $timestamps = false;

    public function yonetici()
    {
        $yonetici = $this->hasOne(CspHRJob::class, 'USER_CODE', 'PARENT_USERNAME')
        ->select('USER_CODE', 'PARENT_USERNAME','EMAIL','PHONE',DB::raw('CONCAT("FIRSTNAME",\' \', "LASTNAME") AS "FULLNAME"'));
        return $yonetici ? $yonetici : false;
    }

    public function childs() {
        return $this->hasMany('App\Models\CspHRJob','PARENT_USERNAME','USER_CODE')
        ->where('status',true)
        ->whereIn('PAYROLLAREA',[10,20,30,40])
        ->whereNotIn('POSITION_NAME',['STAJYER'])
        ->select('USER_CODE', 'PARENT_USERNAME','POSITION_NAME','DEPARTMENT_NAME',DB::raw('CONCAT("FIRSTNAME",\' \', "LASTNAME") AS "FULLNAME"'))
        ->orderBy('FIRSTNAME','asc')
        ->orderBy('UNIT_NAME','asc');
    }

    public function childs_with_home_office() {
        return $this->hasMany('App\Models\CspHRJob','PARENT_USERNAME','USER_CODE')
        ->where('status',true)
        ->whereIn('PAYROLLAREA',[10,20,30,40])
        ->whereNotIn('POSITION_NAME',['STAJYER'])
        ->whereIn(DB::raw('"FUNCTION_CODE"::integer'),[50017617])
        ->select('USER_CODE', 'PARENT_USERNAME','POSITION_NAME','DEPARTMENT_NAME',DB::raw('CONCAT("FIRSTNAME",\' \', "LASTNAME") AS "FULLNAME"'))
        ->orderBy('FIRSTNAME','asc')
        ->orderBy('UNIT_NAME','asc');
    }

    public function gelecek_nobetler(){
        return $this->setConnection('pgsql')->hasMany('App\Models\Nobet','personel','USER_CODE')->withCasts([
            'USER_CODE' => 'integer',
        ])->whereRaw('nobet_tarihi >= current_date')->orderBy('nobet_tarihi','ASC');
    }

    public function gecmis_nobetler(){
        return $this->setConnection('pgsql')->hasMany('App\Models\Nobet','personel','USER_CODE')->withCasts([
            'USER_CODE' => 'integer',
        ])->whereRaw('nobet_tarihi < current_date')->orderBy('nobet_tarihi','ASC');
    }

    public function tum_nobetler(){
        return $this->setConnection('pgsql')->hasMany('App\Models\Nobet','personel','USER_CODE')->withCasts([
            'USER_CODE' => 'integer',
        ])
        ->join('hours', 'hours.id', '=', 'nobets.nobet_tipi')
        ->leftJoin('icap_turu','icap_turu.id','=','nobets.icap_turu')
        ->select('nobets.*', 'hours.type', 'hours.detail', 'icap_turu.title', 'icap_turu.code')
        ->orderBy('nobet_tarihi','ASC');
    }

    // Home Office
    public function tum_home_office(){
        return $this->setConnection('pgsql')->hasMany('App\Models\HomeOffice','personel','USER_CODE')->withCasts([
            'USER_CODE' => 'integer',
        ])
        ->orderBy('nobet_tarihi','ASC');
    }
    // Home Office

    public function calisan_sayisi($foreign_key,$local_key,$whereRaw = '1 > 0'){
        return $this->hasMany('App\Models\CspHRJob',$foreign_key,$local_key)
        ->where('status',true)
        ->whereIn('PAYROLLAREA',[10,20,30,40])
        ->whereRaw($whereRaw)
        ->select('id')->count();
    }

    public function contacts($local_key){
        return $this->setConnection('pgsql')->hasMany('App\Models\Contact','foreign_section_id',$local_key)->withCasts([
            $local_key => 'integer',
        ])->orderBy('created_at','ASC')->get();
    }

    public $titleFields = ['DEPARTMENT_NAME'];
}
