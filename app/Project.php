<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Project extends Model implements AudtitableContract
{
    use Auditable;

    protected $primaryKey = 'project_id';
    protected $table = "projects";
}
