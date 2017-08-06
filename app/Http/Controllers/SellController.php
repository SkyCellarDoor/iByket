<?php

namespace App\Http\Controllers;

use App\AutoSpendsModel;
use App\BillModel;
use App\CashRoutesModel;
use App\ClientModel;
use App\ProductModel;
use App\SellsModel;
use App\SellsProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{

    public function index($id = NULL)
    {

        if (!$id == NULL) {
            $client = ClientModel::find($id);
        } else {
            $client = NULL;
        }

        $bills = BillModel::WhatKindBillThisUserCollection();

        $cash = BillModel::where('default_storage', Auth::user()->storage_id)->first();
        //dd($bills);

        return view('sell.sell')
            ->with('client', $client)
            ->with('cash', $cash)
            ->with(['bills' => $bills]);
    }

    public function add_item(Request $request)
    {

        $id = $request->id;

        $product = ProductModel::find($id);
        //dd($product);
        $rnd = str_random(5);

        return view('sell.add_item')
            ->with('product', $product)
            ->with('rnd', $rnd)
            ->render();
    }

    public function complete(Request $request)
    {


        if ($request->client_id != NULL && $request->use_bill == 1) {

            $bill = $request->add_bill_id;
            $value = $request->add_puy_to_client;
            $comments = 'Доплата по продажи № ';
            $client = $request->client_id;
            $use_bill = 1;

            ClientModel::find($client)->addToBill($value);

            $auto_spend_action = 1;

        } elseif ($request->client_id != NULL && $request->use_bill == 0) {

            $bill = $request->bill_id;
            $value = $request->sum;
            $comments = 'Продажа № ';
            $client = $request->client_id;
            $use_bill = 0;

            $auto_spend_action = 0;

        } else {
            $bill = $request->bill_id;
            $value = $request->sum;
            $comments = 'Продажа № ';
            $client = NULL;
            $use_bill = 0;

            $auto_spend_action = 0;

        }

        $new_sell = new SellsModel();
        $new_sell->client_id = $client;
        $new_sell->use_bill = $use_bill;
        $new_sell->summa = $request->sum;
        $new_sell->discount = $request->promotion_sum;
        $new_sell->complete = 1;
        $new_sell->storage_id = Auth::user()->storage_id;
        $new_sell->user_id = Auth::id();
        $new_sell->save();


        $surcharge = new CashRoutesModel();
        $surcharge->client_id = $client;
        $surcharge->bill = $bill;
        $surcharge->value = $value;
        $surcharge->comments = $comments . $new_sell->id;
        $surcharge->sells_id = $new_sell->id;
        $surcharge->storage_id = Auth::user()->storage_id;
        $surcharge->user_id = Auth::id();
        $surcharge->save();

        $id_product = $request->id_product;
        $value_one = $request->value_one;
        $value_many = $request->value_many;
        $price = $request->price;

        if ($auto_spend_action == 1) {

            $auto_spend = new AutoSpendsModel();
            $auto_spend->client_id = $client;
            $auto_spend->value = $request->sum;
            $auto_spend->comments = 'автоматическое списание в счет продажи № ' . $new_sell->id;
            $auto_spend->sells_id = $new_sell->id;
            $auto_spend->save();

            ClientModel::find($client)->spendFromBill($request->sum);

        }
        //dd($request);

        foreach ($id_product as $key => $value) {

            $product_update = ProductModel::find($value);

            if ($product_update->good_model->consist == 1) {

                if ($product_update->amount > 1) {

                    $product_update->amount = $product_update->amount - 1;
                    $separation_original = $product_update;
                    $product_update->save();

                    $separation_original->amount = 1;
                    $separation_original->consist_id = $value;
                    $separation_original->consist_amount = $separation_original->consist_amount - $value_many[$key];

                    $separation = new ProductModel();
                    $separation = $separation_original->replicate();

                    if ($separation->consist_amount == 0) {
                        $separation->amount = 0;
                    }

                    $separation->save();

                    $product_id_sell = $separation->id;
                } else {
                    $product_update->consist_amount = $product_update->consist_amount - $value_many[$key];

                    if ($product_update->consist_amount == 0) {
                        $product_update->amount = 0;
                    }
                    $product_update->save();
                    $product_id_sell = $value;
                }

            } else {
                $product_update->amount = $product_update->amount - $value_one[$key];
                $product_update->save();
                $product_id_sell = $value;

            }

            $update = new SellsProductsModel;
            $update->sells_id = $new_sell->id;
            $update->product_id = $product_id_sell;
            $update->amount = $value_one[$key];
            $update->amount_consist = $value_many[$key];
            $update->price = $price[$key];
            $update->user_id = Auth::id();
            $update->storage_id = Auth::user()->storage_id;;
            $update->save();

        }

        return redirect()->route('sells_list');
    }

    public function sells_list()
    {

        $sells = SellsModel::where('complete', 1)->paginate(15);

        return view('sell.sells_list')->with(['sells' => $sells]);

    }

    public function sell_detail($id)
    {

        $sell = SellsModel::find($id);
        $products = SellsProductsModel::where('sells_id', $id)->get();

        return view('sell.sell_detail')->with(['sell' => $sell])->with(['products' => $products]);

    }
}
