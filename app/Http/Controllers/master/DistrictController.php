<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller as Controller;
use App\Models\District;
use App\Models\City;
use App\Models\Province;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    
    function index()
    {
  
        $response = array();
        $district = District::join('province', 'province.province_id', '=', 'district.province_id')
                    ->join('city', 'city.city_id', '=', 'district.city_id')
                    ->orderBy('province.province_name', 'asc')
                    ->orderBy('city.city_name', 'asc')
                    ->orderBy('district.district_name', 'asc')
                    ->get();
        $response['data'] = $district;

        return View::make('master/district-list', $response);
    }

    public function Form($district_id = null)
    {
        // $this->checkRole();

        $response = array();
        $district = null;
        $province_id = '';
        $city_id = '';
        $district_name = '';
        if (! empty($district_id)) {
            $district = District::where('district_id', $district_id)->first();
            $province_id = empty($district->province_id) ? '' : $district->province_id;
            $city_id = empty($district->city_id) ? '' : $district->city_id;
            $district_name = empty($district->district_name) ? '' : $district->district_name;
        }

        $province = Province::orderBy('province_name', 'asc')->get();
        $city = City::where('province_id', $province_id)->orderBy('city_name', 'asc')->get();

        $response['province_id'] = $province_id;
        $response['city_id'] = $city_id;
        $response['district_name'] = $district_name;
        $response['district_id'] = $district_id;
        $response['province'] = $province;
        $response['city'] = $city;

        return View('master/district-form', $response);
    }

    
    public function districtSetup(Request $request)
    {
        // $this->checkRole();

        $district_id = $request->input('district_id', '');
        $city_id = $request->input('city_id', '');
        $province_id = $request->input('province_id', '');
        $district_name = $request->input('district_name', '');
        $district = null;

        if (! empty($district_id)) {
            $district = District::where('district_id', $district_id)->first();
        }

        if (empty($district)) {
            $district = new District();
        }

        $district->province_id = $province_id;
        $district->city_id = $city_id;
        $district->district_name = $district_name;
        $district->save();

        return Redirect::to('/district');
    }
    //Delete:district/
    public function districtDelete($district_id = null)
    {
        if (! empty($district_id)) {
            $district = District::find($district_id);
            $district->delete();
        }

        return Redirect::to('/district');
    }
}
