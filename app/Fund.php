<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $primaryKey = 'fund_code';
    protected $table = "funds";
}
