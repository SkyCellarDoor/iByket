<?php

namespace App\Http\Controllers;

use App\BillModel;
use App\CashRoutesModel;
use App\MoveMoneyModel;
use App\SpendModel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BillsController extends Controller
{
    public function index() {

        $all_bills = BillModel::all();

        $operations = CashRoutesModel::groupBy('bill')
            ->selectRaw('sum(value) as sum, bill')
            ->pluck('sum', 'bill')->toArray();
        $spend = SpendModel::groupBy('bill')
            ->selectRaw('sum(value) as sum, bill')
            ->pluck('sum', 'bill')->toArray();
        $move = MoveMoneyModel::groupBy('bill')
            ->selectRaw('sum(value) as sum, bill')
            ->pluck('sum', 'bill')->toArray();

        $each_bill = $all_bills->pluck('id')->toArray();

        foreach($each_bill as $bill) {

            if(array_key_exists($bill, $operations)) {
                $o = $operations[$bill];
            }
            else $o = 0;

            if(array_key_exists($bill, $spend)) {
                $s = $spend[$bill];
            }
            else $s = 0;

            if(array_key_exists($bill, $move)) {
                $m = $move[$bill];
            }
            else $m = 0;

            $all_sum[$bill] = $o + $s  + $m;

        }

        return view('bill.bills')->with(['bills' => $all_bills])->with('bill_sum', $all_sum);
    }



    public function move_cash (Request $request){

        //dd($request);

        $this->validate(request(), [
            'value' => 'required',
        ]);

        $data_add = new MoveMoneyModel();

        $data_add -> bill_from = $request -> bill_from;
        $data_add -> bill = $request -> bill_to;
        $data_add -> value = $request -> value;
        $data_add -> comments = $request -> comments;
        $data_add -> user_id = Auth::id();
        $data_add -> save();

        $data_spend = new MoveMoneyModel();

        $data_spend -> bill = $request -> bill_from;
        $data_spend -> bill_from = $request -> bill_to;
        $data_spend -> value = "-". $request -> value;
        $data_spend -> comments = $request -> comments;
        $data_spend -> user_id = Auth::id();
        $data_spend -> save();

        return redirect()->route('bills');
    }


}
