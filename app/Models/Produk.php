<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use UsesUuid;

    protected $primaryKey = 'produk_id';
    protected $table = 'produk';

    
}