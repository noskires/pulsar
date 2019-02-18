<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Client extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'client_code';
    protected $table = "clients";
}
