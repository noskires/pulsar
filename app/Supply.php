<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Supply extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'supply_id';
    protected $table = "supplies";
}
