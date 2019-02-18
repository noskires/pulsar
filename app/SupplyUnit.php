<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class SupplyUnit extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'stock_unit_code';
    protected $table = "stock_units";
}
