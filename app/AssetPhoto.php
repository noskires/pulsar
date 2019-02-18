<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class AssetPhoto extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'asset_photo_code';
    protected $table = "asset_photos";
}
