<?php

namespace App\Http\Controllers\access;

use App\Http\Controllers\Controller as Controller;
use App\Models\Feature;
use App\Models\FeatureGroup;

use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeatureController extends Controller
{
    
    function index()
    {
  
        $response = array();
        $feature = Feature::join('feature_group', 'feature_group.feature_group_id', '=', 'feature.feature_group_id')
                    ->orderBy('feature_group.feature_group_name', 'asc')
                    ->orderBy('feature.feature_name', 'asc')
                    ->get();
        $response['data'] = $feature;

        return View::make('access/feature-list', $response);
    }

    public function Form($feature_id = null)
    {
        // $this->checkRole();

        $response = array();
        $feature = null;
        $feature_group_id = '';
        $feature_name = '';
        $feature_url = '';
        $feature_icon = '';
        $feature_order = '';
        if (! empty($feature_id)) {
            $feature = feature::where('feature_id', $feature_id)->first();
            $feature_group_id = empty($feature->feature_group_id) ? '' : $feature->feature_group_id;
            $feature_name = empty($feature->feature_name) ? '' : $feature->feature_name;
            $feature_url = empty($feature->feature_url) ? '' : $feature->feature_url;
            $feature_icon = empty($feature->feature_icon) ? '' : $feature->feature_icon;
            $feature_order = empty($feature->feature_order) ? '' : $feature->feature_order;
        }

        $feature_group = FeatureGroup::orderBy('feature_group_name', 'asc')->get();
        

        $response['feature_group_id'] = $feature_group_id;
        $response['feature_id'] = $feature_id;
        $response['feature_name'] = $feature_name;
        $response['feature_url'] = $feature_url;
        $response['feature_icon'] = $feature_icon;
        $response['feature_group'] = $feature_group;
        $response['feature_order'] = $feature_order;
        
        return View('access/feature-form', $response);
    }

    
    public function Setup(Request $request)
    {
        // $this->checkRole();

        $feature_id = $request->input('feature_id', '');
        $feature_group_id = $request->input('feature_group_id', '');
        $feature_name = $request->input('feature_name', '');
        $feature_url = $request->input('feature_url', '');
        $feature_icon = $request->input('feature_icon', '');
        $feature_order = $request->input('feature_order', '');
        $feature = null;

        if (! empty($feature_id)) {
            $feature = feature::where('feature_id', $feature_id)->first();
        }

        if (empty($feature)) {
            $feature = new feature();
        }

        $feature->feature_group_id = $feature_group_id;
        $feature->feature_url = $feature_url;
        $feature->feature_icon = $feature_icon;
        $feature->feature_name = $feature_name;
        $feature->feature_order = $feature_order;
        $feature->save();

        return Redirect::to('/feature');
    }
    //Delete:feature/
    public function Delete($feature_id = null)
    {
        if (! empty($feature_id)) {
            $feature = feature::find($feature_id);
            $feature->delete();
        }

        return Redirect::to('/feature');
    }
}
