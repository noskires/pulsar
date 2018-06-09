<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionSlipItem extends Model
{
    protected $primaryKey = 'requisition_slip_item_code';
    protected $table = "requisition_slips_items";
}
