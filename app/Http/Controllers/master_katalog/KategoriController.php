<?php 

namespace App\Http\Controllers\master_katalog;

use App\Http\Controllers\Controller as Controller;
use App\Models\Kategori;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // protected $viewRoles = ['super_admin'];

    public function Index()
    {
        $response = array();
        $kategori = kategori::orderBy('nama_kategori', 'asc')->get();
        $response['data'] = $kategori;

        return View::make('master_katalog/kategori-list', $response);
    }

    public function Form($kategori_id = null)
    {
        $response = array();
        $kategori = null;
        $nama_kategori = '';
        
        if (! empty($kategori_id)) {
            $kategori = kategori::where('kategori_id', $kategori_id)->first();
            $nama_kategori = empty($kategori->nama_kategori) ? '' : $kategori->nama_kategori;
            
        }

        $response['kategori_id'] = $kategori_id;
        $response['nama_kategori'] = $nama_kategori;
        

        return View::make('master_katalog/kategori-form', $response);
    }

    public function Setup(Request $request)
    {
        // $this->checkRole();

        
        $kategori_id = $request->input('kategori_id', '');
        $nama_kategori = $request->input('nama_kategori', '');
        $kategori = null;

        if (! empty($kategori_id)) {
            $request->validate([
                'nama_kategori' => 'required'
            ]);
            $kategori = kategori::where('kategori_id', $kategori_id)->first();
        }

        if (empty($kategori)) {
            $request->validate([
                'nama_kategori' => 'required|unique:kategori,nama_kategori'
            ]);
            $kategori = new kategori();
        }

        $kategori->kategori_id = $kategori_id;
        $kategori->nama_kategori = $nama_kategori;
        $kategori->status_kategori = '1';
        $kategori->save();

        return Redirect::to('/kategori');
    }

    public function Delete($kategori_id = null)
    {
        // $this->checkRole();

        if (! empty($kategori_id)) {
            $kategori = kategori::find($kategori_id);
            $kategori->delete();
        }

        return Redirect::to('/kategori');
    }

    // protected function checkRole()
    // {
    //     $role = Session::get('userRole', function() { return ''; });
    //     if (! in_array(strtolower($role), $this->viewRoles)) {
    //         App::abort(403, 'Unauthorized action.');
    //     }
    // }
}