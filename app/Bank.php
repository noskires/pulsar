<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Bank extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'bank_code';
    protected $table = "banks";
}
