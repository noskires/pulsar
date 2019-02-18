<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Warranty extends Model implements AudtitableContract
{
	use Auditable;

    protected $primaryKey = 'warranty_id';
    protected $table = "warranties";
}
