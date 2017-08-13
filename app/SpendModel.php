<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpendModel extends Model
{
    protected $table = 'spends';

    public function bill_model()
    {
        return $this->hasOne('App\BillModel', 'id', 'bill');
    }

    public function spend_category_model()
    {
        return $this->hasOne('App\CategorySpendModel', 'id', 'category');
    }

    public function spend_subcategory_model()
    {
        return $this->hasOne('App\CategorySubSpend', 'id', 'sub_category');
    }
}
