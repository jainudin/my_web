<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller as Controller;
use App\Models\Village;
use App\Models\District;
use App\Models\City;
use App\Models\Province;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;


class VillageController extends Controller
{
    
    function index()
    {
  
        $response = array();
        $village = village::join('province', 'province.province_id', '=', 'village.province_id')
                    ->join('city', 'city.city_id', '=', 'village.city_id')
                    ->join('district', 'district.district_id', '=', 'village.district_id')
                    ->orderBy('province.province_name', 'asc')
                    ->orderBy('city.city_name', 'asc')
                    ->orderBy('district.district_name', 'asc')
                    ->orderBy('village.village_name', 'asc')
                    ->get();
        $response['data'] = $village;

        return View::make('master/village-list', $response);
    }

    public function Form($village_id = null)
    {
        // $this->checkRole();

        $response = array();
        $village = null;
        $province_id = '';
        $city_id = '';
        $district_id = '';
        $village_name = '';
        $code_zip = '';
        if (! empty($village_id)) {
            $village = village::where('village_id', $village_id)->first();
            $province_id = empty($village->province_id) ? '' : $village->province_id;
            $city_id = empty($village->city_id) ? '' : $village->city_id;
            $district_id = empty($village->district_id) ? '' : $village->district_id;
            $village_name = empty($village->village_name) ? '' : $village->village_name;
            $code_zip = empty($village->code_zip) ? '' : $village->code_zip;
        }

        $province = Province::orderBy('province_name', 'asc')->get();
        $city = City::where('province_id', $province_id)->orderBy('city_name', 'asc')->get();
        $district = District::where('city_id', $city_id)->orderBy('district_name', 'asc')->get();

        $response['province_id'] = $province_id;
        $response['city_id'] = $city_id;
        $response['village_name'] = $village_name;
        $response['village_id'] = $village_id;
        $response['district_id'] = $district_id;
        $response['province'] = $province;
        $response['city'] = $city;
        $response['code_zip'] = $code_zip;
        $response['district'] = $district;

        return View('master/village-form', $response);
    }

    
    public function villageSetup(Request $request)
    {
        // $this->checkRole();

        $village_id = $request->input('village_id', '');
        $district_id = $request->input('district_id', '');
        $city_id = $request->input('city_id', '');
        $province_id = $request->input('province_id', '');
        $village_name = $request->input('village_name', '');
        $code_zip = $request->input('code_zip', '');
        $village = null;

        if (! empty($village_id)) {
            $village = village::where('village_id', $village_id)->first();
        }

        if (empty($village)) {
            $village = new village();
        }

        $village->province_id = $province_id;
        $village->city_id = $city_id;
        $village->district_id = $district_id;
        $village->village_name = $village_name;
        $village->code_zip = $code_zip;
        $village->save();

        return Redirect::to('/village');
    }
    //Delete:village/
    public function villageDelete($village_id = null)
    {
        if (! empty($village_id)) {
            $village = village::find($village_id);
            $village->delete();
        }

        return Redirect::to('/village');
    }
}
