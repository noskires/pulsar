<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class UtilizationItem extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'utilization_item_code';
    protected $table = "utilization_items";
}
