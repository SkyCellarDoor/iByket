<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StorageModel extends Model
{
    protected $table = 'storages';

    public function scopeUserStorage ($query) {

        return $query->where('id', Auth::user()->storage_id)->first();
    }

    public function scopePointSell($query)
    {

        return $query->where('point_sell', 1);
    }

    public function storage_model()
    {
        return $this->hasOne('App\StorageModel', 'id', 'storage_id');
    }
}
