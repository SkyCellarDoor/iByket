<?php

namespace App\Http\Controllers;

use App\AddressDeliveryModel;
use App\BillModel;
use App\ClientModel;
use App\OrdersModel;
use App\OrdersStatusHistoryModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;

class OrderController extends Controller
{
    public function index() {

        $orders = OrdersModel::all();

        $this_week_start = new Carbon('this week');
        $this_week_end = new Carbon('next sunday');
        $today = Carbon::today()->format('Y-m-d');
        $this_hour = Carbon::today()->subHour(1)->format('H');

        $orders_today = OrdersModel::where('time_delivery', 'like', $today . '%')->get()->sortByDesc('time_delivery');

        $orders_today = $orders_today->map(function ($items) {

            $items['hour'] = Carbon::parse($items['time_delivery'])->format('H');

            return $items;
        });

        $orders_today = $orders_today->sortBy('time_delivery')->groupBy('hour');


        //dd($orders_today);

        $this_week_start = Date::parse($this_week_start)->format('d F');
        $this_week_start = mb_convert_case(strval($this_week_start), MB_CASE_TITLE, "UTF-8");

        $this_week_end = Date::parse($this_week_end)->format('d F');
        $this_week_end = mb_convert_case(strval($this_week_end), MB_CASE_TITLE, "UTF-8");

        $today = Date::parse($today)->format('j F');
        $today = mb_convert_case(strval($today), MB_CASE_TITLE, "UTF-8");

        return view('order.orders_list')
            ->with('this_week_start', $this_week_start)
            ->with('this_week_end', $this_week_end)
            ->with('this_hour', $this_hour)
            ->with('today', $today)
            ->with(['orders' => $orders])
            ->with(['orders_today' => $orders_today]);


    }

    public function detail($id)
    {

        Date::setLocale('ru');

        $order = OrdersModel::find($id);
        $client = ClientModel::find($order->client_id);
        $statuses = OrdersStatusHistoryModel::where('order_id', $id)->get()->sortBy('created_at');
        $bills = BillModel::WhatKindBillThisUserCollection();

        $time = $order->time_delivery;
        $time = Date::parse($time)->format('d F H:i');
        $time = mb_convert_case(strval($time), MB_CASE_TITLE, "UTF-8");

        return view('order.order_detail')
            ->with(['statuses' => $statuses])
            ->with('client', $client)
            ->with('bills', $bills)
            ->with('time', $time)
            ->with('order', $order);
    }

    public function new_order($client)
    {

        $client_data = ClientModel::find($client);

        $bills = BillModel::WhatKindBillThisUserCollection();


        return view('order.order')
            ->with('bills', $bills)
            ->with('client', $client_data);
    }

    public function create_order(Request $request)
    {


        //dd($request);


        if ($request->delivery != 0) {
            $address = new AddressDeliveryModel();
            $address->user = $request->client_id;
            $address->address = trim($request->address_delivery);
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

        if ($address_new != NULL) {
            $orders->type = true;
        } else {

            $orders->type = false;
        }

        $orders->consist = NULL;
        $orders->summa = NULL;
        $orders->comments = trim($request->comment);
        $orders->type_delivery = $request->type_order_pay;
        $orders->from_delivery = $request->delivery_from;
        $orders->time_delivery = $request->date_delivery;
        $orders->comment_courier = trim($request->comment_courier);
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

    public function update_order(Request $request)
    {

        $order = OrdersModel::find($request->order_id);

        if ($request->type_order_pay == 0) {
            $order->consist = NULL;
            $order->summa = NULL;
            $order->comments = trim($request->comment);
            $order->time_delivery = $request->date_delivery;
            $order->save();
        } else {


            if ($request->address_delivery != $order->address_model->address) {

                $find = trim($request->address_delivery);

                $address_find = AddressDeliveryModel::where('address', '=', $find)
                    ->where('user', $request->client_id)->first();

                if ($address_find != NULL) {

                    $address_new = $address_find->id;
                } else {

                    $address = new AddressDeliveryModel();
                    $address->user = $request->client_id;
                    $address->address = trim($request->address_delivery);
                    $address->tags = 'Дом';
                    $address->user_id = Auth::id();
                    $address->save();

                    $address_new = $address->id;
                }


            } else {
                $address_new = $order->address_delivery_id;
            }

            $order->consist = NULL;
            $order->summa = NULL;
            $order->comments = trim($request->comment);
            $order->address_delivery_id = $address_new;
            $order->type_delivery = $request->type_order_pay;
            $order->from_delivery = $request->delivery_from;
            $order->time_delivery = $request->date_delivery;
            $order->comment_courier = trim($request->comment_courier);
            $order->save();


        }


        return redirect()->back();
    }



}
