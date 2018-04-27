<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherItem extends Model
{
    protected $primaryKey = 'voucher_item_code';
    protected $table = "voucher_items";
}
