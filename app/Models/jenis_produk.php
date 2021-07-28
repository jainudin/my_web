<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_produk extends Model
{
    use UsesUuid;

    protected $primaryKey = 'jenis_produk_id';
    protected $table = 'jenis_produk';

    
}