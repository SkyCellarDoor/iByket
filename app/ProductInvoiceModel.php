<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInvoiceModel extends Model
{
    protected $table = 'products_invoice';

    public function good_product_invoice_model()
    {
        return $this->hasOne('App\Goods',  'id', 'good_id');
    }

}
