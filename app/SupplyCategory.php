<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplyCategory extends Model
{
    protected $primaryKey = 'supply_category_code';
    protected $table = "supply_categories";
}
