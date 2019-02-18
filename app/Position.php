<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Position extends Model implements AudtitableContract
{
    use Auditable;
    
    protected $primaryKey = 'position_code';
    protected $table = "positions";
}
