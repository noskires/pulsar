<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Supplier extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'supplier_code';
    protected $table = "suppliers";
}
