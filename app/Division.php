<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Division extends Model implements AudtitableContract
{
    use Auditable;
    
    protected $primaryKey = 'division_id';
    protected $table = "divisions";
}
