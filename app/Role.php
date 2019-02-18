<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Role extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'role_code';
    protected $table = "roles";
}
