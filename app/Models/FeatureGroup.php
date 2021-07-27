<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureGroup extends Model
{
    use UsesUuid;

    protected $primaryKey = 'feature_group_id';
    protected $table = 'feature_group';
}