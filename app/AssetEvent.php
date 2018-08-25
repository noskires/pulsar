<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetEvent extends Model
{
    protected $primaryKey = 'asset_event_id';
    protected $table = "asset_events";
}
