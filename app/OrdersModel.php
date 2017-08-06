<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';

    public function status_history_model()
    {
        return $this->hasOne('App\OrdersStatusHistoryModel', 'id','status_id');
    }

    public function client_model()
    {
        return $this->hasOne('App\ClientModel', 'id','client_id');
    }

    public function latestStatus()
    {
        return $this->hasMany('App\OrdersStatusHistoryModel', 'order_id','status_id')
            ->orderBy('created_at', 'desc')->limit(1);
    }
}

