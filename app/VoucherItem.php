<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class VoucherItem extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'voucher_item_code';
    protected $table = "voucher_items";
}
