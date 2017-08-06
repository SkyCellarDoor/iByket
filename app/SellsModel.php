<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellsModel extends Model
{
    protected $table = 'sells';

    public function client_sell_model()
    {
        $client = $this->hasOne('App\ClientModel', 'id', 'client_id');

        return $client;

    }

    public function storage_model()
    {
        return $this->hasOne('App\StorageModel', 'id','storage_id');
    }
}
