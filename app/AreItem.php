<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class AreItem extends Model implements AudtitableContract
{
    use Auditable;
    
    protected $primaryKey = 'are_item_code';
    protected $table = "are_items";
}
