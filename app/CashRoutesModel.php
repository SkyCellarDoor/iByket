<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class CashRoutesModel extends Model
{
    protected $table = 'routs_money';

//    заменяем Carbon на Jenssegers, для локализации

    protected function asDateTime($value)
    {
        return new Date(parent::asDateTime($value));
    }

    public function client_cash_model()
    {
        $client = $this->hasOne('App\ClientModel', 'id', 'client_id');

        return $client;
    }

    public function bill_model()
    {
        $client = $this->hasOne('App\BillModel', 'id', 'bill');

        return $client;
    }

}
