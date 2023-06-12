<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\City;
use App\Models\District;
use App\Models\Location;
use App\Models\RelDistrict;
use App\Models\RelRoute;
use App\Models\Route;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index(Request $r)
    {
        $cities = City::orderBy("name")->get();

        if (isset($r->search)) {
            $datas = Location::where("name", "like", '%' . $r->search . '%');
            $datas = $datas->orderBy("name")->paginate(33);
        } else {
            $datas = Location::orderBy("name")->paginate(33);
        }

        $routes = Route::orderBy("name")->get();
        $shifts = Shift::orderBy("id")->get();
        $branches = isset($cities[0]['id']) ? Branch::where("city_id", $cities[0]['id'])->where("status", 1)->orderBy("name")->get() : [];
        return view("admin.locations.index")->with(['datas' => $datas, 'cities' => $cities, 'routes' => $routes, 'branches' => $branches, 'shifts' => $shifts, 'r' => $r->all()]);
    }

    public function save(Request $r)
    {
        try {
            $check = Location::where("city_id", $r->city)->where("name", $r->location)->count();
            if ($check > 0) {
                return "no";
            }

            DB::beginTransaction();

            $new = new Location;
            $new->fill($r->all());
            $new->save();

            $coDistricts = count($r->districts);

            if ($coDistricts > 0) {
                RelDistrict::where("location_id", $new->id)->update(["status" => 0]);
                foreach ($r->districts as $district) {

                    RelDistrict::updateOrCreate(
                        ["location_id" => $new->id, "district_id" => $district],
                        ["location_id" => $new->id, "district_id" => $district, "status" => 1]
                    );
                }
            }

            DB::commit();

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function getUpdateForm(Request $r)
    {
        $locationID = $r->id;
        $locations = Location::where("id", $locationID)->first();
        $districts = RelDistrict::where("location_id", $locationID)->where("status", 1)->pluck("district_id");
        $cities = City::orderBy("name")->where("status", 1)->get();
        $branches = Branch::orderBy("name")->where("status", 1)->get();
        $shifts = Shift::orderBy("id")->get();

        $arr = [];
        $arr = [
            'locationID' => $r->id,
            'locations' => $locations,
            'districts' => $districts,
            'cities' => $cities,
            'branches' => $branches,
            'shifts' => $shifts
        ];

        return $arr;
    }

    public function update(Request $r)
    {
        try {

            DB::beginTransaction();

            $new = Location::find($r->id);
            $new->fill($r->all());
            $new->save();

            $coDistricts = count($r->districts);

            if ($coDistricts > 0) {
                RelDistrict::where("location_id", $r->id)->update(["status" => 0]);
                foreach ($r->districts as $district) {
                    RelDistrict::updateOrCreate(
                        ["location_id" => $r->id, "district_id" => $district],
                        ["location_id" => $r->id, "district_id" => $district, "status" => 1]
                    );
                }
            }

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

            $new = Location::find($r->id);
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
