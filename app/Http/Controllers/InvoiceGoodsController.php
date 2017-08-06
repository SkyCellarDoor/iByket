<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProvidersModel;
use App\m_invoices_list;
use App\IncompleteInvoicesModel;
use Illuminate\Support\Facades\Auth;
use App\Goods;

class InvoiceGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = ProvidersModel::where('role', 2)->get();

        return view('invoice_income', ['providers' => $providers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $id_user = Auth::id();
        //$storage_id = Auth::storage_id();

        $empity_good = new IncompleteInvoicesModel;
        $empity_good -> invoice_id = $request-> id;
        $empity_good -> box_id =  0;
        $empity_good -> good_id =  0;
        $empity_good -> cost_income =  0;
        $empity_good -> cost_income_r = 0;
        $empity_good -> cost_end =  0;
        $empity_good -> cost_sell_id =  0;
        $empity_good -> cost_sell_opt_id =  0;
        $empity_good -> amount =  0;
        $empity_good -> storage_id =  0;
        $empity_good -> user_id = $id_user;
        $empity_good -> save();

        return json_encode(['Good' => 'Yes']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $id = Auth::id();

        $data = new m_invoices_list;
        $data -> cost_unit = $request -> cost_unit;
        $data -> cost_delivery = $request -> cost_delivery;
        $data -> provider_id = $request -> provider_id;
        $data -> use_bill = $request -> use_bill;
        $data -> done = false;
        $data -> user_id = $id;
        $data -> real_date = $request -> real_date;
        $data -> save();
        $last_id = m_invoices_list::orderBy('id', 'desc')->first()->id;

        // добавление первого товара для новой накладной
        $first_good = new IncompleteInvoicesModel;
        $first_good -> invoice_id =  $last_id;
        $first_good -> box_id =  0;
        $first_good -> good_id =  0;
        $first_good -> cost_income =  0;
        $first_good -> cost_income_r = 0;
        $first_good -> cost_end =  0;
        $first_good -> cost_sell_id =  0;
        $first_good -> cost_sell_opt_id =  0;
        $first_good -> amount =  0;
        $first_good -> storage_id =  0;
        $first_good -> user_id =  $id;
        $first_good -> save();

        return json_encode(['id' => $last_id]);

    }

    public function add_goods($id)
    {
        $invoice = m_invoices_list::where('id', $id)->pluck('cost_delivery');
        $cost_unit = m_invoices_list::where('id', $id)->pluck('cost_unit');
        $goods = IncompleteInvoicesModel::where('invoice_id', $id)->get();
        $goods_name = Goods::all();
        return view('invoice_income_good', ['goods' => $goods])
            ->with(['id'=>$id])
            ->with('goods_name', $goods_name)
            ->with('invoice', $invoice)
            ->with('cost_unit', $cost_unit);

    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $data = IncompleteInvoicesModel::find($id);
        $data -> good_id = $request -> good_id;
        $data -> amount = $request -> amount;
        $data -> cost_income = $request -> cost_income;
        $data -> cost_income_r = $request -> cost_income_r;
        $data -> cost_end = $request -> cost_end;
        $data -> save();

        return json_encode(['Good' => $request -> good_id]);

    }

    public function update_end(Request $request)
    {
        $id = $request->id;
        $data = IncompleteInvoicesModel::find($id);
        $data -> cost_end = $request -> cost_end;
        $data -> save();

        return json_encode(['Good' => $request -> cost_end]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request -> id;
        $data = IncompleteInvoicesModel::find($id);
        $response = $data -> delete();
        if($response){
            return json_encode(['Good' => 'Yes']);
        }
        else
            echo "There was a problem. Please try again later.";
    }

    public function end(Request $request)
    {
        $id = $request -> id_invoice;
        $data = m_invoices_list::find($id);
        $data -> done = true;
        $data -> save();

        return json_encode(['Good' => $request -> end]);
    }
}
