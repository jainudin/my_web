<?php 

namespace App\Http\Controllers\master_katalog;

use App\Http\Controllers\Controller as Controller;
use App\Models\Produk;
use App\Models\List_gambar_produk;
use View;
use URL;
use Redirect;
use Session;
use App;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Image;
class ListGambarProdukController extends Controller
{
    // protected $viewRoles = ['super_admin'];

    public function Index($produk_id)
    {
        

        $response = array();
        $list_gambar_produk = list_gambar_produk::join('produk', 'produk.produk_id', '=', 'list_gambar_produk.produk_id')
        ->where('produk.produk_id', $produk_id)
        ->get();
        $response['data'] = $list_gambar_produk;
        $response['produk_id'] = $produk_id;
        $response['function'] = 'List';
        return View::make('master_katalog/list_gambar_produk', $response);
    }

    public function Form($produk_id = null)
    {
        $response = array();
        
        $response['produk_id'] = $produk_id;
        $response['function'] = 'Form';
        

        return View::make('master_katalog/list_gambar_produk', $response);
    }

    public function Setup(Request $request)
    {
        // $this->checkRole();

        
        $produk_id = $request->input('produk_id', '');
                      
        $list_gambar_produk = null;

        if (! empty($list_gambar_produk_id)) {
            $request->validate([
                'nama_list_gambar_produk' => 'required'
            ]);
            $list_gambar_produk = list_gambar_produk::where('list_gambar_produk_id', $list_gambar_produk_id)->first();
        }

        if (empty($list_gambar_produk)) {
            $request->validate([
                'nama_list_gambar_produk' => 'required|unique:list_gambar_produk,nama_list_gambar_produk'
            ]);
            $list_gambar_produk = new list_gambar_produk();
            $list_gambar_produk_id = Uuid::uuid4()->getHex();
        }

        //Upload Image
        $filePath = public_path('file_upload/list_gambar_produk/thumbnails');
        $image = $request->file('path_gambar_list_gambar_produk');
        $img = Image::make($image->path());
        if (!file_exists($filePath)) {
            mkdir($filePath, 666, true);
            $img->resize(400, 200, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$list_gambar_produk_id . '.png');
        }
        else
        {
            $img->resize(400, 250, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$list_gambar_produk_id . '.png');
        }

        
        $path = $request->file('path_gambar_list_gambar_produk')->move(public_path('file_upload/list_gambar_produk'), $list_gambar_produk_id . '.png');

        $list_gambar_produk->list_gambar_produk_id = $list_gambar_produk_id;
        $list_gambar_produk->nama_list_gambar_produk = $nama_list_gambar_produk;
        $list_gambar_produk->keterangan_list_gambar_produk = $keterangan_list_gambar_produk;
        $list_gambar_produk->order_list_gambar_produk = $order_list_gambar_produk;
        $list_gambar_produk->path_gambar_list_gambar_produk = $list_gambar_produk_id . ".png";
        $list_gambar_produk->status_list_gambar_produk = '1';
        $list_gambar_produk->save();

        return Redirect::to('/list_gambar_produk');
    }

    public function Delete($list_gambar_produk_id = null)
    {
        // $this->checkRole();

        if (! empty($list_gambar_produk_id)) {
            $list_gambar_produk = list_gambar_produk::find($list_gambar_produk_id);
            $list_gambar_produk->delete();
        }

        return Redirect::to('/list_gambar_produk');
    }

    // protected function checkRole()
    // {
    //     $role = Session::get('userRole', function() { return ''; });
    //     if (! in_array(strtolower($role), $this->viewRoles)) {
    //         App::abort(403, 'Unauthorized action.');
    //     }
    // }
}