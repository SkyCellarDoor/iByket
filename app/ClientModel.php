<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    protected $table = 'users';

    public function scopeClients($query) {

        return $query->where('role', 1);
    }

    public function scopeProviders($query) {

        return $query->where('role', 2);
    }

    public function providers_model()
    {
        return $this->hasOne('App\ProvidersModel',  'id', 'company_id');
    }

    public function spendFromBill ($value){

        $this -> bill = $this -> bill - $value;
        $this->save();

    }

    public function addToBill ($value){

        $this -> bill = $this -> bill + $value;
        $this->save();
    }


}
