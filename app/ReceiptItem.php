<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    protected $primaryKey = 'receipt_item_code';
    protected $table = "receipt_items";
}
