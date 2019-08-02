<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class PurchaseOrder extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'purchase_order_id';
    protected $table = "purchase_orders";
}
