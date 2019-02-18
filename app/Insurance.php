<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AudtitableContract;

class Insurance extends Model implements AudtitableContract
{
    use Auditable;
    
    protected $primaryKey = 'insurance_code';
    protected $table = "insurance";
}
