<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class RoleItem extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'role_item_code';
    protected $table = "role_items";
}
