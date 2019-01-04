<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundItem extends Model
{
    protected $primaryKey = 'fund_item_code';
    protected $table = "fund_items";
}
