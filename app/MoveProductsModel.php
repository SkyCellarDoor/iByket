<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoveProductsModel extends Model
{
    protected $table = 'move_products';


    public function user_take_model()
    {
        $client = $this->hasOne('App\ClientModel', 'id', 'user_take');

        return $client;
    }

    public function user_model()
    {
        $client = $this->hasOne('App\ClientModel', 'id', 'user_id');

        return $client;
    }

    public function storage_from_model()
    {
        $client = $this->hasOne('App\StorageModel', 'id', 'from_storage');

        return $client;
    }

    public function storage_to_model()
    {
        $client = $this->hasOne('App\StorageModel', 'id', 'to_storage');

        return $client;
    }
}
