<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $primaryKey = 'module_code';
    protected $table = "modules";
}
