<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Region extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'region_id';
    protected $table = "regions";
}
