<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostRetailModel extends Model
{
    protected $table = 'cost_retail';

    public function scopeOnePrice($query)
    {
        return $query->where('type', 1);
    }

    public function scopeManyPrice($query)
    {
        return $query->where('type', 0);
    }
}
