<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class AssetEvent extends Model implements AudtitableContract
{
    use Auditable;
    
    protected $primaryKey = 'asset_event_id';
    protected $table = "asset_events";
}
