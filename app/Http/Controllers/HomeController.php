<?php

namespace App\Http\Controllers;

use App\ClientModel;
use App\SellsModel;
use App\StorageModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        if (Auth::user()->role != 5) {
            return view('home_worker');
        }

        $storages = StorageModel::all();

        // фильтрую сервисный магазин с id 0
        $storages = $storages->filter(function ($value) {

            return $value->id != 0;

        });


// график продаж
        $sells = SellsModel::all('created_at', 'summa')->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d'); // групирую по дням

        });

        $sells = $sells->map(function ($item) {
            $item = $item->sum('summa');
            return $item;
        });


        return view('home')
            ->with(['storages' => $storages])
            ->with(['sells' => $sells]);
    }

    public function logout()
    {

        Auth::logout();
        return view('auth.login');
    }

    public function change_storage()
    {
        $storages = StorageModel::PointSell()->get();

        return view('skyapp.change_store')->with(['storages' => $storages]);
    }

    public function update_storage(Request $request)
    {
        $user = ClientModel::find($request->user_id);

        $user->storage_id = $request->storage;
        $user->save();

        return redirect('/home');
    }
}
