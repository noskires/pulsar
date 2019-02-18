<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class ReceiptItem extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'receipt_item_code';
    protected $table = "receipt_items";
}
