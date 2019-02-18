<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Unit extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'unit_id';
    protected $table = "units";
}
