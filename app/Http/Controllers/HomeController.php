<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\District;
use App\Models\Driver;
use App\Models\Location;
use App\Models\RelDistrict;
use App\Models\Route;
use App\Models\ServiceManager;
use App\Models\Shift;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $r)
    {
        //dd("y");
        $branches = Branch::all();
        $shifts = Shift::all();
        $datas = [];
        
        if (isset($r->districts[0]) || isset($r->route_id)) {
            if (isset($r->districts[0]) && is_int(intval($r->districts[0])) == true) {
                $districtIDs = District::where("id", $r->districts[0])->pluck('id');
            }

            if (!isset($r->districts[0]) && isset($r->route_id) && is_int(intval($r->route_id)) == true)
            {
                $districtIDs = District::where("route_id", $r->route_id)->pluck('id');
            }

            $locationIDs = RelDistrict::whereIn('district_id', $districtIDs)->where('status', 1)->pluck('location_id');
            if (isset($r->shift)) {
                $locationIDs = Location::whereIn("id", $locationIDs)->where("shift_id", $r->shift)->where('status', 1)->pluck('id');
            }

            if (isset($r->branch)) {
                $locationIDs = Location::whereIn("id", $locationIDs)->where("branch_id", $r->branch)->where('status', 1)->pluck('id');
            }
            

            $datas = Driver::whereIn('location_id', $locationIDs)->where('status', 1)->get();
        }

        $routes = Route::orderBy("name")->get();
        return view("welcome")->with(["datas" => $datas, "r" => $r, "routes" => $routes, "shifts" => $shifts, "branches" => $branches]);
    }

    public function post()
    {
        return "test";
    }
}
