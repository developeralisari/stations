<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\City;
use App\Models\ServiceManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function index(Request $r)
    {
        $branches= Branch::orderBy("name", "asc");

        if (isset($r->search)) {
            $branches= $branches->where("name", "LIKE", "%" . $r->search . "%");
        }

        $branches= $branches->paginate(9);
        $cities = City::select("id","name")->where("status", 1)->orderBy("name")->get();
        return view("admin.branches.index")->with(["datas" => $branches, "r" => $r->all(), "cities" => $cities]);
    }

    public function save(Request $r)
    {
        try {
            $check = Branch::where("city_id", $r->city_id)->where("name", $r->name)->count();
            if ($check > 0) {
                return "no";
            }

            DB::beginTransaction();

            $new = new Branch;
            $new->fill($r->all());
            $new->save();

            DB::commit();

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function saveServiceManager(Request $r)
    {
        try {
            $check = ServiceManager::where("phone", $r->phone)->where("name", $r->name)->count();
            if ($check > 0) {
                return "no";
            }

            DB::beginTransaction();

            $new = new ServiceManager;
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

            $new = Branch::find($r->id);
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
        $datas = Branch::where("id", $r->id)->first();
        $cities = City::where("status", 1)->select("id","name")->get();
        $arr = [];
        $arr = [
            'branchID' => $r->id,
            'datas' => $datas,
            'cities' => $cities
        ];

        return $arr;
    }

    public function getUpdateFormServiceManager(Request $r)
    {
        $datas = ServiceManager::where("branch_id", $r->id)->first();
        return $datas;
    }

    public function update(Request $r)
    {
        try {

            DB::beginTransaction();

            $new = Branch::find($r->id);
            $new->fill($r->all());
            $new->city_id = 1;
            $new->save();

            DB::commit();

            return "ok";
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function updateServiceManager(Request $r)
    {
        try {

            DB::beginTransaction();

            $new = ServiceManager::find($r->id);
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
