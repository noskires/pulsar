<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Receipt extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'receipt_id';
    protected $table = "receipts";
}
