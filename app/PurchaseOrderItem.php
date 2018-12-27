<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $primaryKey = 'po_item_code';
    protected $table = "purchase_order_items";
}
