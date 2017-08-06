<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersStatusHistoryModel extends Model
{
    protected $table = 'orders_status_history';

    public function status_name_model()
    {
        return $this->hasOne('App\OrdersStatusNameModel', 'id','status_name_id');
    }

    public function orders_model()
    {
        return $this->hasOne('App\OrdersModel', 'id','order_id');


    }
}

