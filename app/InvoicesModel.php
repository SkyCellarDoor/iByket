<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicesModel extends Model
{
    protected $table = 'invoices';

    public function user_provider_model()
    {
        return $this->hasOne('App\ClientModel',  'id', 'provider_id');
    }
}
