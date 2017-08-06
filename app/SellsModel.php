<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellsModel extends Model
{
    protected $table = 'sells';

    public function client_model()
    {
        return $this->hasOne('App\ClientModel', 'id','client_id');
    }

    public function storage_model()
    {
        return $this->hasOne('App\StorageModel', 'id','storage_id');
    }
}
