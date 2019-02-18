<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Fund extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'fund_code';
    protected $table = "funds";
}
