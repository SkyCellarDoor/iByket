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
}
