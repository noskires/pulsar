<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Utilization extends Model implements AudtitableContract
{
	use Auditable;
	
    protected $primaryKey = 'utilization_code';
    protected $table = "utilizations";
}
