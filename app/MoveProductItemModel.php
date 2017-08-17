<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoveProductItemModel extends Model
{
    protected $table = 'move_products_items';


    public function move_product_item_model()
    {
        $client = $this->hasOne('App\ProductModel', 'id', 'product_id');

        return $client;
    }
}
