<?php 

namespace App\Http\Controllers\master_katalog;

use App\Http\Controllers\Controller as Controller;
use App\Models\jenis_produk;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    // protected $viewRoles = ['super_admin'];

    public function Index()
    {
        $response = array();
        $jenis_produk = jenis_produk::orderBy('nama_jenis_produk', 'asc')->get();
        $response['data'] = $jenis_produk;
        $response['function'] = 'List';

        return View::make('master_katalog/jenis_produk', $response);
    }

    public function Form($jenis_produk_id = null)
    {
        $response = array();
        $jenis_produk = null;
        $nama_jenis_produk = '';
        
        if (! empty($jenis_produk_id)) {
            $jenis_produk = jenis_produk::where('jenis_produk_id', $jenis_produk_id)->first();
            $nama_jenis_produk = empty($jenis_produk->nama_jenis_produk) ? '' : $jenis_produk->nama_jenis_produk;
            
        }

        $response['jenis_produk_id'] = $jenis_produk_id;
        $response['nama_jenis_produk'] = $nama_jenis_produk;
        $response['function'] = 'Form';
        

        return View::make('master_katalog/jenis_produk', $response);
    }

    public function Setup(Request $request)
    {
        // $this->checkRole();

        
        $jenis_produk_id = $request->input('jenis_produk_id', '');
        $nama_jenis_produk = $request->input('nama_jenis_produk', '');
        $jenis_produk = null;

        if (! empty($jenis_produk_id)) {
            $request->validate([
                'nama_jenis_produk' => 'required'
            ]);
            $jenis_produk = jenis_produk::where('jenis_produk_id', $jenis_produk_id)->first();
        }

        if (empty($jenis_produk)) {
            $request->validate([
                'nama_jenis_produk' => 'required|unique:jenis_produk,nama_jenis_produk'
            ]);
            $jenis_produk = new jenis_produk();
        }

        $jenis_produk->jenis_produk_id = $jenis_produk_id;
        $jenis_produk->nama_jenis_produk = $nama_jenis_produk;
        $jenis_produk->status_jenis_produk = '1';
        $jenis_produk->save();

        return Redirect::to('/jenis_produk');
    }

    public function Delete($jenis_produk_id = null)
    {
        // $this->checkRole();

        if (! empty($jenis_produk_id)) {
            $jenis_produk = jenis_produk::find($jenis_produk_id);
            $jenis_produk->delete();
        }

        return Redirect::to('/jenis_produk');
    }

    // protected function checkRole()
    // {
    //     $role = Session::get('userRole', function() { return ''; });
    //     if (! in_array(strtolower($role), $this->viewRoles)) {
    //         App::abort(403, 'Unauthorized action.');
    //     }
    // }
}