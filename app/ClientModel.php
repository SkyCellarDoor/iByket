<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
    protected $table = 'users';

    public function scopeClients($query) {

        return $query->where('role', 1);
    }

    public function scopeWorker($query)
    {

        return $query->where('role', 3);
    }

    public function scopeProviders($query) {

        return $query->where('role', 2);
    }

    public function scopeWholesales($query)
    {

        return $query->where('role', 6);
    }

    public function providers_model()
    {
        return $this->hasOne('App\ProvidersModel',  'id', 'company_id');
    }

    public function sell_storage_model()
    {
        return $this->hasOne('App\StorageModel', 'id', 'storage_id');
    }

    public function wholesales_model()
    {
        return $this->hasOne('App\ProvidersModel', 'id', 'company_id');
    }

    public function spendFromBill ($value){

        $this -> bill = $this -> bill - $value;
        $this->save();

    }

    public function addToBill ($value){

        $this -> bill = $this -> bill + $value;
        $this->save();
    }

    public function getPhoneAttribute($value)
    {

        return $this->attributes['phone'] =
            "+" .
            substr($value, 0, 1) . "(" .
            substr($value, 1, 3) . ")" .
            substr($value, 4, 3) . "-" .
            substr($value, 7, 2) . "-" .
            substr($value, 9, 2);
    }



}
