<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    protected $primaryKey = 'job_order_id';
    protected $table = "job_orders";
}
