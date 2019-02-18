<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class FundItem extends Model implements AudtitableContract
{
    use Auditable;
    
    protected $primaryKey = 'fund_item_code';
    protected $table = "fund_items";
}
