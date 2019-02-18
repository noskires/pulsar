<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class SupplyCategory extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'supply_category_code';
    protected $table = "supply_categories";
}
