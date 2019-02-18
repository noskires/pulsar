<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Voucher extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'voucher_id';
    protected $table = "vouchers";
}
