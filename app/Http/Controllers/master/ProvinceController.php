<?php 

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller as Controller;
use App\Models\Province;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    // protected $viewRoles = ['super_admin'];

    public function provinceList()
    {
        // $role = Session::get('userRole', function() { return ''; });
        // if (! in_array(strtolower($role), $this->viewRoles)) {
        //     App::abort(403, 'Unauthorized action.');
        // }

        $response = array();
        $province = Province::orderBy('province_name', 'asc')->get();
        $response['data'] = $province;

        return View::make('master/province-list', $response);
    }

    public function provinceForm($provinceId = null)
    {
        // $this->checkRole();

        $response = array();
        $province = null;
        $provinceName = '';
        if (! empty($provinceId)) {
            $province = Province::where('province_id', $provinceId)->first();
            $provinceName = empty($province->province_name) ? '' : $province->province_name;
        }

        $provinceListUrl = URL::route('province-list');
        $provinceSubmitUrl = URL::route('province-submit');
        $response['provinceListUrl'] = $provinceListUrl;
        $response['provinceSubmitUrl'] = $provinceSubmitUrl;
        $response['provinceName'] = $provinceName;
        $response['provinceId'] = $provinceId;

        return View::make('master/province-form', $response);
    }

    public function provinceSetup(Request $request)
    {
        // $this->checkRole();

        $provinceId = $request->input('provinceId', '');
        $provinceName = $request->input('provinceName', '');
        $province = null;

        if (! empty($provinceId)) {
            $province = Province::where('province_id', $provinceId)->first();
        }

        if (empty($province)) {
            $province = new Province();
        }

        $province->province_name = $provinceName;
        $province->save();

        return Redirect::to('/province');
    }

    public function provinceDelete($provinceId = null)
    {
        // $this->checkRole();

        if (! empty($provinceId)) {
            $province = Province::find($provinceId);
            $province->delete();
        }

        return Redirect::to('/province');
    }

    // protected function checkRole()
    // {
    //     $role = Session::get('userRole', function() { return ''; });
    //     if (! in_array(strtolower($role), $this->viewRoles)) {
    //         App::abort(403, 'Unauthorized action.');
    //     }
    // }
}