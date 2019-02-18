<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Operation extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'operation_id';
    protected $table = "operations";
}
