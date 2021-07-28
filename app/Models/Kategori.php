<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use UsesUuid;

    protected $primaryKey = 'kategori_id';
    protected $table = 'kategori';

    
}
