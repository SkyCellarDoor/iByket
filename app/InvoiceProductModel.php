<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceProductModel extends Model
{
    protected $table = 'products_invoice';

    public function invoice_product_good_model()
    {
        return $this->hasOne('App\Goods',  'id', 'good_id');
    }
}
