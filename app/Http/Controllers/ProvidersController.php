<?php

namespace App\Http\Controllers;

use App\BillModel;
use App\CashRoutesModel;
use App\ClientModel;
use App\InvoicesModel;
use App\ProvidersModel;
use App\TypeCompanyModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvidersController extends Controller
{
    public function index()
    {
        $providers = ClientModel::Providers()->with('providers_model')->get();

        $types = TypeCompanyModel::all();

        //dd($providers);
        return view('providers.providers')
            ->with(['types'=> $types])
            ->with(['providers' => $providers]);
    }

    public function detail($id)
    {
        $provider = ClientModel::find($id);
        $bills = BillModel::all();

        $invoices = InvoicesModel::where('provider_id', $id)->get();

        //dd($provider);

        return view('providers.provider_detail')
            ->with(['invoices' => $invoices])
            ->with('bills', $bills)
            ->with('provider', $provider);
    }

    public function add(Request $request) {

        $provider = new ProvidersModel();
        $provider -> company = $request -> name_company;
        $provider -> type = $request -> type;
        $provider -> save();

        $id = $provider->id;

        $user = new User();
        $user -> role = 2;
        $user -> company_id = $id;
        $user -> bill = 0;
        $user -> save();

        //return redirect()->route('detail_view', ['id' => $data->id]);

        return redirect('/provider/'.$user -> id);

    }

    public function fin(Request $request)
    {

        //dd($request);

        if ($request->type_op == 1) {

            $value = $request->value;
            $value_client = '-' . $request->value;
        } else {
            $value = '-' . $request->value;
            $value_client = $request->value;

        }

        $id = $request->client_id;

        $data = new CashRoutesModel();
        $data->value = $value;
        $data->client_id = $id;
        $data->bill = $request->bill;
        $data->comments = $request->comments;
        $data->user_id = Auth::id();
        $data->storage_id = Auth::user()->storage_id;
        $data->save();

        $client = ClientModel::find($id);
        $client->bill = $client->bill + $value_client;
        $client->save();


        return redirect()->back();

    }
}
