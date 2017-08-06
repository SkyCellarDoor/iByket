<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GoodsConsistNameModel;

class Goods extends Model
{
    protected $table = 'goods';


    public function one_name_model()
    {
        return $this->hasOne('App\GoodsConsistNameModel', 'id', 'one_name_id');
    }

    public function many_name_model()
    {
        return $this->hasOne('App\GoodsConsistNameModel', 'id', 'many_name_id');
    }

    public function categories_model()
    {
        return $this->hasOne('App\CategoryGoodModel', 'id', 'category_good_id');
    }

    public function one_good_price_all()
    {
        return $this->hasOne('App\CostRetailModel', 'good_id', 'id');
    }
}
