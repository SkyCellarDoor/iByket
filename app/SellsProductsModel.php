<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class
SellsProductsModel extends Model
{
    protected $table = 'sells_products';

    public function product_model() {
        return $this->hasOne('App\ProductModel',  'id', 'product_id');

    }

    public function sells_model() {
        return $this->hasOne('App\SellsModel',  'id', 'sells_id');

    }
}
