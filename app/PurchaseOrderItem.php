<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class PurchaseOrderItem extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'po_item_code';
    protected $table = "purchase_order_items";
}
