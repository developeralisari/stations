<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Route;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index(Request $r)
    {
        $cities = City::orderBy("name", "asc");

        if (isset($r->search)) {
            $cities = $cities->where("name", "ILIKE", "%" . $r->search . "%");
        }

        $cities = $cities->paginate(9);
        return view("admin.cities.index")->with(["datas" => $cities, "r" => $r->all()]);
    }

    public function save(Request $r)
    {
        try {
            $check = City::where("name", $r->name)->count();
            if ($check > 0) {
                return "no";
            }

            DB::beginTransaction();

            $new = new City;
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

            $new = City::find($r->id);
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
        $datas = City::where("id", $r->id)->first();
        $arr = [];
        $arr = [
            'cityID' => $r->id,
            'datas' => $datas
        ];

        return $arr;
    }

    public function getRouteUpdateForm(Request $r)
    {
        $datas = Route::where("city_id", $r->id)->where("status", 1)->orderBy("name")->pluck("name");
        return $datas;
    }

    public function getDistrictUpdateForm(Request $r)
    {
        $datas = Route::select("id","name")->where("city_id", $r->id)->where("status", 1)->orderBy("name")->get();
        return $datas;
    }

    public function getDistrictForm(Request $r)
    {
        $datas = District::where("city_id", $r->id)->where("route_id", $r->routeID)->where("status", 1)->orderBy("name")->pluck("name");
        return $datas;
    }

    public function update(Request $r)
    {
        try {

            DB::beginTransaction();

            $new = City::find($r->id);
            $new->fill($r->all());
            $new->save();

            DB::commit();

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function updateRoutes(Request $r)
    {
        $names = explode(PHP_EOL, $r->name);
        Route::where("city_id", $r->id)->update(['status' => 0]);
        foreach($names as $n)
        {
            $n = preg_replace( "/\r|\n/", "", $n );
            if(strlen($n) > 0)
            {
                Route::updateOrCreate(
                    ['city_id' => $r->id,'name' => $n],
                    ['name' => $n, 'status' => 1]
                );
            }
        }
        return "ok";
    }

    public function updateDistricts(Request $r)
    {
        $names = explode(PHP_EOL, $r->name);
        District::where("city_id", $r->id)->where("route_id", $r->routeID)->update(['status' => 0]);
        foreach($names as $n)
        {
            $n = preg_replace( "/\r|\n/", "", $n );
            if(strlen($n) > 0)
            {
                District::updateOrCreate(
                    ['city_id' => $r->id,'route_id' => $r->routeID,'name' => $n],
                    ['city_id' => $r->id,'route_id' => $r->routeID,'name' => $n, 'status' => 1]
                );
            }
        }
        return "ok";
    }
}
