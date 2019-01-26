<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleItem extends Model
{
    protected $primaryKey = 'role_item_code';
    protected $table = "role_items";
}
