<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;


class SellsModel extends Model
{
    protected $table = 'sells';

    //    заменяем Carbon на Jenssegers, для локализации

    protected function asDateTime($value)
    {
        return new Date(parent::asDateTime($value));
    }

    public function client_sell_model()
    {
        $client = $this->hasOne('App\ClientModel', 'id', 'client_id');

        return $client;

    }

    public function worker_model()
    {
        $client = $this->hasOne('App\ClientModel', 'id', 'user_id');

        return $client;

    }

    public function storage_model()
    {
        return $this->hasOne('App\StorageModel', 'id','storage_id');
    }
}
