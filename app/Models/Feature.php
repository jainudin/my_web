<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class feature extends Model
{
    use UsesUuid;

    protected $primaryKey = 'feature_id';
    protected $table = 'featureP';
}