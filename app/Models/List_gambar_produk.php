<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class List_gambar_produk extends Model
{
    use UsesUuid;
    protected $primaryKey = 'list_gambar_produk_id';
    protected $table = 'list_gambar_produk';

}