<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Particular extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'particular_id';
    protected $table = "particulars";
}
