<?php 

namespace App\Http\Controllers\master_katalog;

use App\Http\Controllers\Controller as Controller;
use App\Models\Produk;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // protected $viewRoles = ['super_admin'];

    public function Index()
    {
        $response = array();
        
        $produk = produk::join('kategori', 'kategori.kategori_id', '=', 'produk.kategori_id')
                    ->orderBy('kategori.nama_kategori', 'asc')
                    ->orderBy('produk.nama_produk', 'asc')
                    ->get();
        $response['data'] = $produk;
        $response['function'] = 'List';
        return View::make('master_katalog/produk', $response);
    }

    public function Form($produk_id = null)
    {
        $response = array();
        $produk = null;
        $nama_produk = '';
        
        if (! empty($produk_id)) {
            $produk = produk::where('produk_id', $produk_id)->first();
            $nama_produk = empty($produk->nama_produk) ? '' : $produk->nama_produk;
            
        }

        $response['produk_id'] = $produk_id;
        $response['nama_produk'] = $nama_produk;
        $response['function'] = 'Form';

        return View::make('master_katalog/produk', $response);
    }

    public function Setup(Request $request)
    {
        // $this->checkRole();

        
        $produk_id = $request->input('produk_id', '');
        $nama_produk = $request->input('nama_produk', '');
        $produk = null;

        if (! empty($produk_id)) {
            $request->validate([
                'nama_produk' => 'required'
            ]);
            $produk = produk::where('produk_id', $produk_id)->first();
        }

        if (empty($produk)) {
            $request->validate([
                'nama_produk' => 'required|unique:produk,nama_produk'
            ]);
            $produk = new produk();
        }

        $produk->produk_id = $produk_id;
        $produk->nama_produk = $nama_produk;
        $produk->status_produk = '1';
        $produk->save();

        return Redirect::to('/produk');
    }

    public function Delete($produk_id = null)
    {
        // $this->checkRole();

        if (! empty($produk_id)) {
            $produk = produk::find($produk_id);
            $produk->delete();
        }

        return Redirect::to('/produk');
    }

    // protected function checkRole()
    // {
    //     $role = Session::get('userRole', function() { return ''; });
    //     if (! in_array(strtolower($role), $this->viewRoles)) {
    //         App::abort(403, 'Unauthorized action.');
    //     }
    // }
}