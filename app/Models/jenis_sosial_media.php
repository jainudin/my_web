<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_sosial_media extends Model
{
    use UsesUuid;

    protected $primaryKey = 'jenis_sosial_media_id';
    protected $table = 'jenis_sosial_media';

    
}