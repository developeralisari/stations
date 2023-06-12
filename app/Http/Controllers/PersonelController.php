<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonelController extends Controller
{
    public function index(Request $r)
    {
        $personels= Personel::orderBy("name", "asc");

        if (isset($r->search)) {
            $personels= $personels->where("name", "ILIKE", "%" . $r->search . "%");
        }

        $personels= $personels->paginate(9);
        $drivers = Driver::select("id","name","plate","location_id")->where("status", 1)->orderBy("name")->get();
        return view("admin.personels.index")->with(["datas" => $personels, "r" => $r->all(), "drivers" => $drivers]);
    }

    public function save(Request $r)
    {
        try {
            $check = Personel::where("driver_id", $r->driver_id)->where("name", $r->name)->where("phone", $r->phone)->count();
            if ($check > 0) {
                return "no";
            }

            DB::beginTransaction();

            $new = new Personel;
            $new->fill($r->all());
            $new->save();

            DB::commit();

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function updateStatus(Request $r)
    {
        try {

            DB::beginTransaction();

            $new = Personel::find($r->id);
            $new->fill($r->all());
            $new->save();

            DB::commit();

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function getUpdateForm(Request $r)
    {
        $datas = Personel::where("id", $r->id)->first();
        $drivers = Driver::select("id","name","plate","location_id")->where("status", 1)->orderBy("name")->get();
        $arr = [];
        $arr = [
            'datas' => $datas,
            'drivers' => $drivers
        ];

        return $arr;
    }

    public function update(Request $r)
    {
        try {

            DB::beginTransaction();

            $new = Personel::find($r->id);
            $new->fill($r->all());
            $new->save();

            DB::commit();

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    } 
}
