<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoveMoneyModel extends Model
{
    protected $table = 'move_money';

    public function bill_model()
    {
        $client = $this->hasOne('App\BillModel', 'id', 'bill');

        return $client;
    }
}
