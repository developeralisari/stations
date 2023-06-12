<?php

namespace App\Http\Controllers;

use App\Mail\ChangeMail;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DriverController extends Controller
{
    public function index(Request $r)
    {
        $drivers = Driver::orderBy("name", "asc");

        if (isset($r->search)) {
            $drivers = $drivers->where("name", "LIKE", "%" . $r->search . "%");
        }

        $drivers = $drivers->paginate(9);
        $locations = Location::select("id", "name", "link")->where("status", 1)->orderBy("name")->get();
        return view("admin.drivers.index")->with(["datas" => $drivers, "r" => $r->all(), "locations" => $locations]);
    }

    public function save(Request $r)
    {
        try {
            $check = Driver::where("location_id", $r->location_id)->where("name", $r->name)->count();
            if ($check > 0) {
                return "no";
            }

            DB::beginTransaction();

            $new = new Driver;
            $new->fill($r->all());
            $new->city_id = 1;
            $new->save();

            DB::commit();

            try {
                $location = Location::select("name")->where("id", $r->location_id)->first();
                $personels = Personel::select("email")->where("driver_id", $r->id)->where("status", 1)->get();

                $details = [
                    "locationName" => $location->name,
                    "driverName" => $new->name,
                    "plate" => $new->plate,
                    "phone" => $new->phone,
                ];

                foreach ($personels as $p) {
                    $to = $p->email;
                    Mail::to($to)->send(new ChangeMail($details));
                }
            } catch (Exception $m) {
            }


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

            $new = Driver::find($r->id);
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
        $datas = Driver::where("id", $r->id)->first();
        $locations = Location::where("id", $r->locationID)->where("status", 1)->select("id", "name")->first();
        $arr = [];
        $arr = [
            'driverID' => $r->id,
            'datas' => $datas,
            'locations' => $locations
        ];

        return $arr;
    }

    public function update(Request $r)
    {

        try {

            DB::beginTransaction();

            $new = Driver::find($r->id);
            $new->fill($r->all());
            $new->save();

            DB::commit();

            $checkUpdate = $new->wasChanged();
            //dd($check);
            if ($checkUpdate) {
                try {
                    $location = Location::select("name")->where("id", $r->location_id)->first();
                    $personels = Personel::select("email")->where("driver_id", $r->id)->where("status", 1)->get();

                    $details = [
                        "locationName" => $location->name,
                        "driverName" => $new->name,
                        "plate" => $new->plate,
                        "phone" => $new->phone,
                    ];

                    foreach ($personels as $p) {
                        $to = $p->email;
                        Mail::to($to)->send(new ChangeMail($details));
                    }
                } catch (Exception $m) {
                }
            }

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
