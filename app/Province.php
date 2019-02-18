<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Province extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'province_id';
    protected $table = "provinces";
}
