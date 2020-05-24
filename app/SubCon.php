<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class SubCon extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'subcon_code';
    protected $table = "subcons";
}
