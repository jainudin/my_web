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
use Ramsey\Uuid\Uuid;
use Image;

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
        //$path_foto_perusahaan = '';
        $path_logo_perusahaan = '';
        $website_perusahaan = '';
        $email_perusahaan = '';
        $tentang_perusahaan = '';
        
        if (! empty($profil_perusahaan_id)) {
            $profil_perusahaan = profil_perusahaan::where('profil_perusahaan_id', $profil_perusahaan_id)->first();
            $nama_perusahaan = empty($profil_perusahaan->nama_perusahaan) ? '' : $profil_perusahaan->nama_perusahaan;
            $alamat_perusahaan = empty($profil_perusahaan->alamat_perusahaan) ? '' : $profil_perusahaan->alamat_perusahaan;
            //$path_foto_perusahaan = empty($profil_perusahaan->path_foto_perusahaan) ? '' : $profil_perusahaan->path_foto_perusahaan;
            $path_logo_perusahaan = empty($profil_perusahaan->path_logo_perusahaan) ? '' : $profil_perusahaan->path_logo_perusahaan;
            $website_perusahaan = empty($profil_perusahaan->website_perusahaan) ? '' : $profil_perusahaan->website_perusahaan;
            $email_perusahaan = empty($profil_perusahaan->email_perusahaan) ? '' : $profil_perusahaan->email_perusahaan;
            $tentang_perusahaan = empty($profil_perusahaan->tentang_perusahaan) ? '' : $profil_perusahaan->tentang_perusahaan;
            
        }

        $response['profil_perusahaan_id'] = $profil_perusahaan_id;
        $response['nama_perusahaan'] = $nama_perusahaan;
        $response['alamat_perusahaan'] = $alamat_perusahaan;
        //$response['path_foto_perusahaan'] = $path_foto_perusahaan;
        $response['path_logo_perusahaan'] = $path_logo_perusahaan;
        $response['website_perusahaan'] = $website_perusahaan;
        $response['email_perusahaan'] = $email_perusahaan;
        $response['tentang_perusahaan'] = $tentang_perusahaan;
        $response['function'] = 'Form';
        

        return View::make('kontak/profil_perusahaan', $response);
    }

    public function Setup(Request $request)
    {
        $profil_perusahaan_id = $request->input('profil_perusahaan_id', '');
        $nama_perusahaan = $request->input('nama_perusahaan', '');
        $alamat_perusahaan = $request->input('alamat_perusahaan', '');
        $website_perusahaan = $request->input('website_perusahaan', '');
        $email_perusahaan = $request->input('email_perusahaan', '');
        $tentang_perusahaan = $request->input('tentang_perusahaan', '');

        $profil_perusahaan = null;

        if (! empty($profil_perusahaan_id)){
            $request->validate([
                'nama_perusahaan' => 'required'
            ]);
            $profil_perusahaan = profil_perusahaan::where('profil_perusahaan_id', $profil_perusahaan_id)->first();
        }

        if (empty($profil_perusahaan)){
            $request->validate([
                'nama_perusahaan' => 'required|unique:profil_perusahaan,nama_perusahaan'
            ]);
            $profil_perusahaan = new profil_perusahaan();
            $profil_perusahaan_id = Uuid::uuid4()->getHex();
        }

        //Upload Image
        $filePath = public_path('file_upload/profil_perusahaan/thumbnails');
        $image = $request->file('path_logo_perusahaan');
        $img = Image::make($image->path());
        if (!file_exists($filePath)){
            mkdir($filePath, 666, true);
            $img->resize(400,250, function ($const){
                $const->aspectRatio();
            })->save($filePath.'/'.$profil_perusahaan_id . '.png');
        }

        $path = $request->file('path_logo_perusahaan')->move(public_path('file_upload/profil_perusahaan'), $profil_perusahaan_id . '.png');

        $profil_perusahaan->profil_perusahaan_id = $profil_perusahaan_id;
        $profil_perusahaan->nama_perusahaan = $nama_perusahaan;
        $profil_perusahaan->alamat_perusahaan = $alamat_perusahaan;
        $profil_perusahaan->path_foto_perusahaan = $profil_perusahaan_id . ".png";
        $profil_perusahaan->path_logo_perusahaan = $profil_perusahaan_id . ".png";
        $profil_perusahaan->website_perusahaan = $website_perusahaan;
        $profil_perusahaan->email_perusahaan = $email_perusahaan;
        $profil_perusahaan->tentang_perusahaan = $tentang_perusahaan;
        $profil_perusahaan->status = '1';
        $profil_perusahaan->save();

        return Redirect::to('/profil_perusahaan');
    }

}