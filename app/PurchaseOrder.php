<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $primaryKey = 'po_code';
    protected $table = "purchase_orders";
}
