<?php 

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller as Controller;
use App\Models\City;
use App\Models\Province;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;

class CityController extends Controller
{
    // protected $viewRoles = ['super_admin'];

    public function cityList()
    {
        // $role = Session::get('userRole', function() { return ''; });
        // if (! in_array(strtolower($role), $this->viewRoles)) {
        //     App::abort(403, 'Unauthorized action.');
        // }

        $response = array();
        $city = City::join('province', 'province.province_id', '=', 'city.province_id')
                    ->orderBy('province.province_name', 'asc')
                    ->orderBy('city.city_name', 'asc')
                    ->get();
        $response['data'] = $city;

        return View::make('master/city-list', $response);
    }

    public function cityForm($cityId = null)
    {
        // $this->checkRole();

        $response = array();
        $city = null;
        $provinceId = '';
        $cityName = '';
        if (! empty($cityId)) {
            $city = City::where('city_id', $cityId)->first();
            $provinceId = empty($city->province_id) ? '' : $city->province_id;
            $cityName = empty($city->city_name) ? '' : $city->city_name;
        }

        $province = Province::orderBy('province_name', 'asc')->get();

        $cityListUrl = URL::route('city-list');
        $citySubmitUrl = URL::route('city-submit');
        $response['cityListUrl'] = $cityListUrl;
        $response['citySubmitUrl'] = $citySubmitUrl;
        $response['provinceId'] = $provinceId;
        $response['cityName'] = $cityName;
        $response['cityId'] = $cityId;
        $response['province'] = $province;

        return View::make('master/city-form', $response);
    }

    public function citySetup(Request $request)
    {
        // $this->checkRole();

        $cityId = $request->input('cityId', '');
        $provinceId = $request->input('provinceId', '');
        $cityName = $request->input('cityName', '');
        $city = null;

        if (! empty($cityId)) {
            $city = City::where('city_id', $cityId)->first();
        }

        if (empty($city)) {
            $city = new City();
        }

        $city->province_id = $provinceId;
        $city->city_name = $cityName;
        $city->save();

        return Redirect::to('/city');
    }

    public function cityDelete($cityId = null)
    {
        // $this->checkRole();

        if (! empty($cityId)) {
            $city = City::find($cityId);
            $city->delete();
        }

        return Redirect::to('/city');
    }

    // protected function checkRole()
    // {
    //     $role = Session::get('userRole', function() { return ''; });
    //     if (! in_array(strtolower($role), $this->viewRoles)) {
    //         App::abort(403, 'Unauthorized action.');
    //     }
    // }
}