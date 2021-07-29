<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profil_perusahaan extends Model
{
    use UsesUuid;

    protected $primaryKey = 'profil_perusahaan_id';
    protected $table = 'profil_perusahaan';

    
}