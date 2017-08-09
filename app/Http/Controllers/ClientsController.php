<?php

namespace App\Http\Controllers;

use App\AutoSpendsModel;
use App\BillModel;
use App\OrdersModel;
use App\SellsModel;
use function foo\func;
use Illuminate\Http\Request;
use App\ClientModel;
use App\CashRoutesModel;
use App\User;
use Illuminate\Support\Facades\Auth;
use function PHPSTORM_META\map;

class ClientsController extends Controller
{

    public function create(Request $request){

        $phone = $request->phone;

        $phone = str_replace('-', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);

        $data = new ClientModel();
        $data -> role = 1;
        $data -> name = $request -> name;
        $data->phone = $phone;
        $data -> bill = 0;
        $data -> save();

        return redirect()->route('detail_view', ['id' => $data->id]);

    }

    public function index(){

        $results = ClientModel::clients()->paginate(15);
        return view('client.client_search', ['results_out' => $results]);

    }

    public function search(Request $request){

        $search_text = $request -> text_s_aj;
        $results = ClientModel::clients()->where('name','like', '%'.$search_text.'%')
            ->orWhere('phone','like', '%'.$search_text.'%')
            ->get();

        $result_table = view('client.search_user_result', ['results' => $results])->render();
        return json_encode($result_table);
    }

    public function detail($id){

        $client = User::where('id', $id)->first();
        $bills_operation = CashRoutesModel::where('client_id', $id)->orderBy('created_at', 'desc')->get();
        $auto_operation = AutoSpendsModel::where('client_id', $id)->orderBy('created_at', 'desc')->get();
        $all_op = $bills_operation->merge($auto_operation)->sortBy('created_at');

        $phone = $client->phone;

        $phone = "+7(" .
            substr($phone, 0, 3) . ")" .
            substr($phone, 3, 3) . "-" .
            substr($phone, 6, 2) . "-" .
            substr($phone, 8, 2);

        $bills = BillModel::WhatKindBillThisUserCollection();
        $sells = SellsModel::where('client_id', $id)->where('complete', 1)->get();
        $orders = OrdersModel::where('client_id', $id)->get();
        $sell_sum = $sells->sum('summa');

        //dd($bills_operation);
        return view('client.client_detail')
            ->with('client', $client)
            ->with('sell_sum', $sell_sum)
            ->with('phone', $phone)
            ->with(['bills' => $bills])
            ->with(['orders' => $orders])
            ->with(['sells' => $sells])
            ->with(['bills_operation' => $all_op]);

    }


    public function fin_operation(Request $request){

        //dd($request);

        if ($request -> type_op == 0) {
            $value = $request->value;
        }

        else {
            $value = '-'.$request->value;
        }
        $id = $request-> client_id;

        $data = new CashRoutesModel();
        $data -> value = $value;
        $data -> client_id = $id;
        $data -> bill = $request -> bill;
        $data -> comments = $request -> comments;
        $data -> user_id = Auth::id();
        $data -> storage_id = Auth::user()->storage_id;
        $data -> save();

        $client = ClientModel::find($id);
        $client -> bill = $client -> bill + $value;


        $client -> save();


        return redirect()->back();
    }

    public function json ($query){

        $results = ClientModel::Clients()->where('name','like', '%'.$query.'%')
            ->orWhere('phone','like', '%'.$query.'%')
            ->get();

        $results->map(function ($item) {

            $item['phone'] = "+7(" .
                substr($item['phone'], 0, 3) . ")" .
                substr($item['phone'], 3, 3) . "-" .
                substr($item['phone'], 6, 2) . "-" .
                substr($item['phone'], 8, 2);
        });

        $results = $results->toJson();

        return "{\"results\":".$results."}";

    }

    public function promise_client (){

        $promise_clients = ClientModel::Clients()->where('bill', '<', 0)->get();

        return view('client.promise_clients')->with(['clients' => $promise_clients]);

    }
}
