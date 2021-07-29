<?php

namespace App\Http\Controllers\kontak;

use App\Http\Controllers\Controller as Controller;
use App\Models\profil_perusahaan;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;

class ProfilPerusahaanController extends Controller
{
    public function Index()
    {
        $response = array();
        $profil_perusahaan = profil_perusahaan::orderBy('nama_perusahaan', 'asc')->get();
        $response['data'] = $profil_perusahaan;
        $response['function'] = 'List';

        return View::make('kontak/profil_perusahaan', $response);
    }

    public function Form($profil_perusahaan_id = null)
    {
        $response = array();
        $profil_perusahaan = null;
        $nama_perusahaan = '';
        $alamat_perusahaan = '';
        $path_foto_perusahaan = '';
        $path_logo_perusahaan = '';
        $website_perusahaan = '';
        $email_perusahaan = '';
        $tentang_perusahaan = '';
        
        if (! empty($profil_perusahaan_id)) {
            $profil_perusahaan = profil_perusahaan::where('profil_perusahaan_id', $profil_perusahaan_id)->first();
            $nama_perusahaan = empty($profil_perusahaan->nama_perusahaan) ? '' : $profil_perusahaan->nama_perusahaan;
            $alamat_perusahaan = empty($profil_perusahaan->alamat_perusahaan) ? '' : $profil_perusahaan->alamat_perusahaan;
            $path_foto_perusahaan = empty($profil_perusahaan->path_foto_perusahaan) ? '' : $profil_perusahaan->path_foto_perusahaan;
            $path_logo_perusahaan = empty($profil_perusahaan->path_logo_perusahaan) ? '' : $profil_perusahaan->path_logo_perusahaan;
            $website_perusahaan = empty($profil_perusahaan->website_perusahaan) ? '' : $profil_perusahaan->website_perusahaan;
            $email_perusahaan = empty($profil_perusahaan->email_perusahaan) ? '' : $profil_perusahaan->email_perusahaan;
            $tentang_perusahaan = empty($profil_perusahaan->tentang_perusahaan) ? '' : $profil_perusahaan->tentang_perusahaan;
            
        }

        $response['profil_perusahaan_id'] = $profil_perusahaan_id;
        $response['nama_perusahaan'] = $nama_perusahaan;
        $response['alamat_perusahaan'] = $alamat_perusahaan;
        $response['path_foto_perusahaan'] = $path_foto_perusahaan;
        $response['path_logo_perusahaan'] = $path_logo_perusahaan;
        $response['website_perusahaan'] = $website_perusahaan;
        $response['email_perusahaan'] = $email_perusahaan;
        $response['tentang_perusahaan'] = $tentang_perusahaan;
        $response['function'] = 'Form';
        

        return View::make('kontak/profil_perusahaan', $response);
    }

}