<?php

namespace App\Http\Controllers;

use App\BillModel;
use App\CashRoutesModel;
use App\ClientModel;
use App\Goods;
use App\GoodsConsistNameModel;
use App\InvoiceProductModel;
use App\InvoicesModel;
use App\m_invoices_list;
use App\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function detail($id)
    {

        $invoice = InvoicesModel::find($id);

        $products = InvoiceProductModel::where('invoice_id', $id)->get();

        return view('invoice.detail_invoice')
            ->with('invoice', $invoice)
            ->with(['products' => $products]);
    }

    public function invoice_list()
    {

        $invoice_list = m_invoices_list::All();

        $providers = ClientModel::Providers()->get();

        //dd($providers);

        return view('invoice.invoices', ['invoice_list' => $invoice_list])->with(['providers' => $providers]);
    }

    public function create(Request $request)
    {

        $new_invoice = new InvoicesModel();
        $new_invoice->cost_unit = 0;
        $new_invoice->cost_delivery = 0;
        $new_invoice->amount_box = NULL;
        $new_invoice->provider_id = $request->provider;
        $new_invoice->use_bill = $request->bill_use;
        $new_invoice->user_id = Auth::id();
        $new_invoice->real_date = $request->real_date;
        $new_invoice->done = false;
        $new_invoice->save();

        //dd($request);
        return redirect()->route('invoice_edit', ['id' => $new_invoice->id]);

    }

    public function edit($id)
    {

        $invoice = InvoicesModel::find($id);

        $type_consist = GoodsConsistNameModel::all();

        $bills = BillModel::all();

        return view('invoice.edit_invoice')
            ->with(['type_consist' => $type_consist])
            ->with(['bills' => $bills])
            ->with('invoice', $invoice);
    }

    public function add_item(Request $request)
    {

        $id = $request->id;

        if ($request->name) {

            if ($request->consist == 0) {
                $consist = false;
            } else {
                $consist = true;
            }

            $name = mb_convert_case($request->name, MB_CASE_TITLE, "UTF-8");

            $exist = Goods::where('name', 'like', $name)->get()->toArray();

            if (count($exist) == 1) {
                return 'stop';
            }

            $good = new Goods();
            $good->name = $name;
            $good->category_id = NULL;
            $good->sub_category_id = NULL;
            $good->description = $request->description;
            $good->consist = $consist;
            $good->one_name_id = $request->one_name_id;
            $good->many_name_id = $request->many_name_id;
            $good->user_id = Auth::id();
            $good->save();

            $id = $good->id;
        }

        $product = Goods::find($id);

        $rnd = str_random(5);

        return view('invoice.table_items')->with('product', $product)->with('rnd', $rnd)->render();
    }

    public function complete(Request $request)
    {

        //dd($request);

        $amount = $request->count;
        $consist_amount = $request->count_many;
        $price_one = $request->price_one;
        $price_many = $request->price_many;

        $products = $request->id_product;

        foreach ($products as $key => $value) {

            $product = new ProductModel();
            $product->invoice_id = $request->invoice_id;
            $product->good_id = $value;
            $product->amount = $amount[$key];
            $product->consist_amount = $consist_amount[$key];
            $product->consist_amount_was = $consist_amount[$key];
            $product->cost_end = $price_one[$key];
            $product->consist_cost_end = $price_many[$key];
            $product->storage_id = Auth::user()->storage_id;
            $product->user_id = Auth::id();
            $product->save();
        }

        foreach ($products as $key => $value) {

            $product = new InvoiceProductModel();
            $product->invoice_id = $request->invoice_id;
            $product->good_id = $value;
            $product->amount = $amount[$key];
            $product->consist_amount = $consist_amount[$key];
            $product->consist_amount_was = $consist_amount[$key];
            $product->cost_end = $price_one[$key];
            $product->consist_cost_end = $price_many[$key];
            $product->storage_id = Auth::user()->storage_id;
            $product->user_id = Auth::id();
            $product->save();
        }

        $invoice = InvoicesModel::find($request->invoice_id);
        $invoice->summa = $request->sum;
        $invoice->done = 1;
        $invoice->save();

        if ($request->use_bill == 1) {

            $money = new CashRoutesModel();
            $money->client_id = $request->provider_id;
            $money->bill = $request->bill_id;
            $money->value = '-' . $request->sum;
            $money->comments = 'Оплата накладной № ' . $request->invoice_id;
            $money->user_id = Auth::id();
            $money->storage_id = BillModel::find($request->bill_id)->storage_id;
            $money->save();
        } else {
            $money = ClientModel::find($request->provider_id);
            $money->bill = $money->bill - $request->sum;
            $money->save();
        }

        return redirect()->route('invoice_list');
    }

}



