<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $primaryKey = 'requisition_slip_id';
    protected $table = "requisition_slips";
}
