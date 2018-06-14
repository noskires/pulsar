<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceItem extends Model
{
    protected $primaryKey = 'insurance_item_code';
    protected $table = "insurance_items";
}
