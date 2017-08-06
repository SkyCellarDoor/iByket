<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\CashRoutesModel;
use App\ClientModel;
use Illuminate\Support\Facades\Auth;
use App\BillModel;

class CashController extends Controller
{
    public function cash_operation_client(Request $request){

        $id = $request -> client_id;
        $val = $request -> value;

        $date = new Carbon('now', 'Asia/Krasnoyarsk');

        if ($request -> op_type == 0) {

            $data = new CashRoutesModel;
            $data -> client_id = $id;
            $data -> bill = $request -> type_bill;
            $data -> value = "-".$val;
            $data -> comments = $request -> comments;
            $data -> user_id = Auth::id();
            $data -> created_at = $date;
            $data -> save();

            $client = ClientModel::clients()->find($id);
            $client -> bill = $client -> bill - $val;
            $client -> save();

        }

        if ($request -> op_type == 1) {

            $data = new CashRoutesModel;
            $data -> client_id = $id;
            $data -> bill = $request -> type_bill;
            $data -> value = $val;
            $data -> comments = $request -> comments;
            $data -> user_id = Auth::id();
            $data -> created_at = $date;
            $data -> save();

            $client = ClientModel::clients()->find($id);
            $client -> bill = $client -> bill + $val;
            $client -> save();

        }




        return redirect()->route('detail_view', ['id' => $id]);

    }
}
