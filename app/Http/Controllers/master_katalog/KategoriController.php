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
use Ramsey\Uuid\Uuid;
use Image;
class KategoriController extends Controller
{
    // protected $viewRoles = ['super_admin'];

    public function Index()
    {
        $response = array();
        $kategori = kategori::orderBy('nama_kategori', 'asc')->get();
        $response['data'] = $kategori;
        $response['function'] = 'List';

        return View::make('master_katalog/kategori', $response);
    }

    public function Form($kategori_id = null)
    {
        $response = array();
        $kategori = null;
        $nama_kategori = '';
        $path_gambar_kategori = '';
        $keterangan_kategori = '';
        $order_kategori = '';
                
        if (! empty($kategori_id)) {
            $kategori = kategori::where('kategori_id', $kategori_id)->first();
            $nama_kategori = empty($kategori->nama_kategori) ? '' : $kategori->nama_kategori;
            $path_gambar_kategori = empty($kategori->path_gambar_kategori) ? '' : $kategori->path_gambar_kategori;
            $keterangan_kategori = empty($kategori->keterangan_kategori) ? '' : $kategori->keterangan_kategori;
            $order_kategori = empty($kategori->order_kategori) ? '' : $kategori->order_kategori;
            
        }

        $response['kategori_id'] = $kategori_id;
        $response['nama_kategori'] = $nama_kategori;
        $response['path_gambar_kategori'] = $path_gambar_kategori;
        $response['keterangan_kategori'] = $keterangan_kategori;
        $response['order_kategori'] = $order_kategori;
        $response['function'] = 'Form';
        

        return View::make('master_katalog/kategori', $response);
    }

    public function Setup(Request $request)
    {
        // $this->checkRole();

        
        $kategori_id = $request->input('kategori_id', '');
        $nama_kategori = $request->input('nama_kategori', '');
        $keterangan_kategori = $request->input('keterangan_kategori', '');
        $order_kategori = $request->input('order_kategori', '');
        
               
        $kategori = null;

        if (! empty($kategori_id)) {
            $request->validate([
                'nama_kategori' =>'required',
                'path_gambar_kategori' => ['required','dimensions:min_width=400,min_height=250,max_width=800,max_height=300']
           
            ]);
            $kategori = kategori::where('kategori_id', $kategori_id)->first();
        }

        if (empty($kategori)) {
            $request->validate([
                'nama_kategori' =>'required',
                'path_gambar_kategori' => ['required','dimensions:min_width=400,min_height=250,max_width=800,max_height=300']
            ]);
            $kategori = new kategori();
            $kategori_id = Uuid::uuid4()->getHex();
        }

        //Upload Image
        $filePath = public_path('file_upload/kategori/thumbnails');
        $image = $request->file('path_gambar_kategori');
        $img = Image::make($image->path());
        if (!file_exists($filePath)) {
            mkdir($filePath, 666, true);
            $img->resize(400, 250, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$kategori_id . '.png');
        }
        else
        {
            $img->resize(400, 250, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$kategori_id . '.png');
        }

        
        $path = $request->file('path_gambar_kategori')->move(public_path('file_upload/kategori'), $kategori_id . '.png');

        $kategori->kategori_id = $kategori_id;
        $kategori->nama_kategori = $nama_kategori;
        $kategori->keterangan_kategori = $keterangan_kategori;
        $kategori->order_kategori = $order_kategori;
        $kategori->path_gambar_kategori = $kategori_id . ".png";
        $kategori->status_kategori = '1';
        $kategori->save();
        $kategori->save();
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