<?php 

namespace App\Http\Controllers\master_katalog;

use App\Http\Controllers\Controller as Controller;
use App\Models\Produk;
use App\Models\kategori;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;
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
        $kategori_id = '';
        $nama_produk = '';
        $path_gambar_produk = '';
        $keterangan_produk = '';
       
        
        if (! empty($produk_id)) {

            $produk = produk::where('produk_id', $produk_id)->first();
            $produk_id = empty($produk->produk_id) ? '' : $produk->produk_id;
            $nama_produk = empty($produk->nama_produk) ? '' : $produk->nama_produk;
            $kategori_id = empty($produk->kategori_id) ? '' : $produk->kategori_id;
            $path_gambar_produk = empty($produk->path_gambar_produk) ? '' : $produk->path_gambar_produk;
            $keterangan_produk = empty($produk->keterangan_produk) ? '' : $produk->keterangan_produk;
            
        }

        $kategori = kategori::orderBy('nama_kategori', 'asc')->get();
        $response['produk_id'] = $produk_id;
        $response['kategori_id'] = $kategori_id;
        $response['nama_produk'] = $nama_produk;
        $response['path_gambar_produk'] = $path_gambar_produk;
        $response['keterangan_produk'] = $keterangan_produk;
        $response['status_produk'] = '1';
        $response['kategori'] = $kategori;
        $response['function'] = 'Form';

        return View::make('master_katalog/produk', $response);
    }

    public function Setup(Request $request)
    {
        // $this->checkRole();
        
        $produk_id = $request->input('produk_id', '');
        $kategori_id = $request->input('kategori_id', '');
        $nama_produk = $request->input('nama_produk', '');
        $path_gambar_produk = $request->input('path_gambar_produk', '');
        $keterangan_produk = $request->input('keterangan_produk', '');
        
        $produk = null;

        if (! empty($produk_id)) {
            $request->validate([
                'nama_produk' => 'required',
                'path_gambar_produk' =>'required'
            ]);
            $produk = produk::where('produk_id', $produk_id)->first();
        }

        if (empty($produk)) {
            $request->validate([
                'nama_produk' => 'required|unique:produk,nama_produk',
                'path_gambar_produk' =>'required'
            ]);
            $produk = new produk();
            $produk_id = Uuid::uuid4()->getHex();
        }

        //Upload Image
        
        
        $path = $request->file('path_gambar_produk')->move(public_path('file_upload/produk'), $produk_id . '.png');
         
        $produk->produk_id = $produk_id;
        $produk->nama_produk = $nama_produk;
        $produk->keterangan_produk = $keterangan_produk;
        $produk->kategori_id = $kategori_id;
        $produk->path_gambar_produk =  $produk_id . '.png';
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

   
}