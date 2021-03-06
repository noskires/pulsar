<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Are extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'are_code';
    protected $table = "ares";
}
