<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilizationItem extends Model
{
    protected $primaryKey = 'utilization_item_code';
    protected $table = "utilization_items";
}
