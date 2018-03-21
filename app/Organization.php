<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizations extends Model
{
    protected $primaryKey = 'org_id';
    protected $table = "organizations";
}
