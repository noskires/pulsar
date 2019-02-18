<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class InsuranceItem extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'insurance_item_code';
    protected $table = "insurance_items";
}
