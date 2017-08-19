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

    public function SumBill()
    {

        $operations = CashRoutesModel::where('bill', $this->id)->get()->sum('value');
        $spend = SpendModel::where('bill', $this->id)->get()->sum('value');
        $move = MoveMoneyModel::where('bill', $this->id)->get()->sum('value');

        $sum = $operations + $move + $spend;

        return $sum;

    }

    public function SumBillShift()
    {
        $shift = ShiftModel::where('storage_id', $this->storage_id)->where('status', false)->first()->begin;

        if ($this->default_storage == NULL) {

            $operations = CashRoutesModel::where('created_at', '>=', $shift)->where('value', '>', 0)->where('bill', $this->id)->get()->sum('value');

            $spend = SpendModel::where('created_at', '>=', $shift)->where('value', '>', 0)->where('bill', $this->id)->get()->sum('value');

            $move = MoveMoneyModel::where('created_at', '>=', $shift)->where('value', '>', 0)->where('bill', $this->id)->get()->sum('value');

            $sum = $operations + $move + $spend;
        } else {

            $operations = CashRoutesModel::where('bill', $this->id)->get()->sum('value');

            $spend = SpendModel::where('bill', $this->id)->get()->sum('value');

            $move = MoveMoneyModel::where('bill', $this->id)->get()->sum('value');

            $sum = $operations + $move + $spend;
        }

        return number_format($sum, 2, '.', ',');

    }

}
