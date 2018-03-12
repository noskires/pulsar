<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    protected $primaryKey = 'asset_id';
    protected $table = "assets";
}
