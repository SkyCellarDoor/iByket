<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BillModel extends Model
{
    protected $table = 'bills';

    public function storage_model()
    {
        return $this->belongsTo('App\StorageModel', 'storage_id', 'id');
    }

    // выбор в массив id всех счетов которым принадлежит магазину пользователя
    public function scopeWhatKindBillThisUser ($query){

        return $query->where('storage_id', Auth::user()->storage_id)->get()->pluck('id')->toArray();
    }

    public function scopeWhatKindBillThisUserCollection ($query){

        return $query->where('storage_id', Auth::user()->storage_id)->get();
    }

}
