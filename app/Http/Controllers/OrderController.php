<?php

namespace App\Http\Controllers;

use App\AddressDeliveryModel;
use App\ClientModel;
use App\OrdersModel;
use App\OrdersStatusHistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {

        $orders = OrdersModel::all();

        return view('order.orders_list')->with(['orders' => $orders]);
    }

    public function detail($id)
    {

        $order = OrdersModel::find($id);
        $statuses = OrdersStatusHistoryModel::where('order_id', $id)->get()->sortBy('created_at');

        return view('order.order_detail')
            ->with(['statuses' => $statuses])
            ->with('order', $order);
    }

    public function new_order($client)
    {

        $client_data = ClientModel::find($client);

        return view('order.order')->with('client', $client_data);
    }

    public function create_order(Request $request)
    {


        //dd($request);


        if ($request->delivery != 0) {
            $address = new AddressDeliveryModel();
            $address->user = $request->client_id;
            $address->address = $request->address_delivery;
            $address->tags = 'Дом';
            $address->user_id = Auth::id();
            $address->save();
            $address_new = $address->id;

        } else {

            $address_new = NULL;

        }


        $orders = new OrdersModel();
        $orders->client_id = $request->client_id;
        $orders->address_delivery_id = $address_new;
        $orders->consist = NULL;
        $orders->summa = NULL;
        $orders->comments = $request->comment;
        $orders->type_delivery = $request->type_order_pay;
        $orders->from_delivery = $request->delivery_from;
        $orders->time_delivery = $request->date_time;
        $orders->comment_courier = $request->comment_courier;
        $orders->status_id = NULL;
        $orders->user_id = Auth::id();
        $orders->storage_id = Auth::user()->storage_id;
        $orders->save();

        $status = new OrdersStatusHistoryModel();
        $status->order_id = $orders->id;
        $status->status_name_id = 1;
        $status->user_id = Auth::id();
        $status->storage_id = Auth::user()->storage_id;
        $status->save();

        $status_update = OrdersModel::find($orders->id);
        $status_update->status_id = $status->id;
        $status_update->save();

        return redirect()->route('order');
    }
}
