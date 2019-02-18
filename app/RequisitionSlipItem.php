<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class RequisitionSlipItem extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'requisition_slip_item_code';
    protected $table = "requisition_slips_items";
}
