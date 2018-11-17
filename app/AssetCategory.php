<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetCategory extends Model
{
    protected $primaryKey = 'asset_category_code';
    protected $table = "asset_categories";
}
