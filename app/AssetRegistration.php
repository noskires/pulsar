<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class AssetRegistration extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'asset_rgstn_code';
    protected $table = "asset_registrations";
}
