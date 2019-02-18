<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Employee extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'employee_id';
    protected $table = "employees";
}
