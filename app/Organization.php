<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Organization extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'org_id';
    protected $table = "organizations";
}
