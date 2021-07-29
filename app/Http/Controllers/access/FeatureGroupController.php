<?php

namespace App\Http\Controllers\access;

use App\Http\Controllers\Controller as Controller;
use App\Models\FeatureGroup;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeatureGroupController extends Controller
{
    
    function index()
    {
  
        $response = array();
        $response = array();
        $feature_group = FeatureGroup::orderBy('feature_group_name', 'asc')->get();
        $response['data'] = $feature_group;
        $response['function'] = 'List';

        return View::make('access/feature-group', $response);
    }

    public function Form($feature_group_id = null)
    {
        // $this->checkRole();

        $response = array();
        $feature_group = null;
        $feature_group_name = '';
        $feature_group_order = '';
        if (! empty($feature_group_id)) {
            $feature_group = FeatureGroup::where('feature_group_id', $feature_group_id)->first();
            $feature_group_name = empty($feature_group->feature_group_name) ? '' : $feature_group->feature_group_name;
            $feature_group_order = empty($feature_group->feature_group_order) ? '' : $feature_group->feature_group_order;
        }

        $response['feature_group_id'] = $feature_group_id;
        $response['feature_group_name'] = $feature_group_name;
        $response['feature_group_order'] = $feature_group_order;
        $response['function'] = 'Form';

        return View('access/feature-group', $response);
    }

   
    public function Setup(Request $request)
    {
        // $this->checkRole();
        $feature_group_id = $request->input('feature_group_id', '');
        $feature_group_name = $request->input('feature_group_name', '');
        $feature_group_order = $request->input('feature_group_order', '');
        $feature_group = null;

        
        if (! empty($feature_group_id)) {
            $request->validate([
                'feature_group_name' => 'required',
                'feature_group_order' => 'required|numeric',
            ]);
    
            $feature_group = FeatureGroup::where('feature_group_id', $feature_group_id)->first();
        }

        if (empty($feature_group)) {
            $request->validate([
                'feature_group_name' => 'required|unique:feature_group,feature_group_name',
                'feature_group_order' => 'required|numeric',
            ]);
    
            $feature_group = new FeatureGroup();
        }

        $feature_group->feature_group_id = $feature_group_id;
        $feature_group->feature_group_name = $feature_group_name;
        $feature_group->feature_group_order = $feature_group_order;
        $feature_group->save();

        return Redirect::to('/feature_group');
    }
    //Delete:feature_group/
    public function Delete($feature_group_id = null)
    {
        if (! empty($feature_group_id)) {
            $feature_group = feature_group::find($feature_group_id);
            $feature_group->delete();
        }

        return Redirect::to('/feature_group');
    }
}
