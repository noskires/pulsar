<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetPhoto extends Model
{
    protected $primaryKey = 'asset_photo_code';
    protected $table = "asset_photos";
}
