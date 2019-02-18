<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class StockUnit extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'stock)unit_id';
    protected $table = "stock_units";
}
