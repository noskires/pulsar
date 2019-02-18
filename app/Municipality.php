<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Municipality extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'Municipality_id';
    protected $table = "Municipalities";
}
