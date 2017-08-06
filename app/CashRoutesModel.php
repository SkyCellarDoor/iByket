<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashRoutesModel extends Model
{
    protected $table = 'routs_money';

    public function client_cash_model()
    {
        $client = $this->hasOne('App\ClientModel', 'id', 'client_id');

        return $client;
    }
}
