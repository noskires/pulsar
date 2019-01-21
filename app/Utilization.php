<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilization extends Model
{
    protected $primaryKey = 'utilization_code';
    protected $table = "utilizations";
}
