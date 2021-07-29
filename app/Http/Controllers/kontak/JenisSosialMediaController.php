<?php

namespace App\Http\Controllers\kontak;

use App\Http\Controllers\Controller as Controller;
use App\Models\jenis_sosial_media;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;

class JenisSosialMediaController extends Controller
{
    public function Index()
    {
        $response = array();
        $jenis_sosial_media = jenis_sosial_media::orderBy('nama_jenis_sosial_media', 'asc')->get();
        $response['data'] = $jenis_sosial_media;
        $response['function'] = 'List';

        return View::make('kontak/jenis_sosial_media', $response);
    }
}