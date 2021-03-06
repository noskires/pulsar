<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Department extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'department_id';
    protected $table = "departments";
}
