<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplyUnit extends Model
{
    protected $primaryKey = 'stock_unit_code';
    protected $table = "stock_units";
}
