<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use Auditable;

    protected $primaryKey = 'audits';
    protected $table = "id";
}
