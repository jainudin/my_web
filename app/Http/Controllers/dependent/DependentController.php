<?php

namespace App\Http\Controllers\dependent;

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

class DependentController extends Controller
{
    function fetch_dropdown(Request $request)
    {
        
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        
        $name = $dependent."_name";
        $id = $dependent."_id";
        $data = DB::table($dependent)
        ->where($select, $value)
        ->get();
        $City = City::orderBy('city_name', 'asc')->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
        $output .= '<option value="'.$row->$id.'">'.$row->$name.'</option>';
        }
        echo $output;
    }

    
}
