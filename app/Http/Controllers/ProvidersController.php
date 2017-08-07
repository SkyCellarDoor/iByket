<?php

namespace App\Http\Controllers;

use App\BillModel;
use App\ClientModel;
use App\ProvidersModel;
use App\TypeCompanyModel;
use App\User;
use Illuminate\Http\Request;

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

        //dd($provider);

        return view('providers.provider_detail')
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
}
