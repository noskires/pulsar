<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Asset extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'asset_id';
    protected $table = "assets";
}
