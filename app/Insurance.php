<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $primaryKey = 'insurance_code';
    protected $table = "insurance";
}
