<?php

namespace App\Http\Controllers;

use App\BillModel;
use App\CashRoutesModel;
use App\ClientModel;
use App\MoveMoneyModel;
use App\SellsModel;
use App\ShiftModel;
use App\SpendModel;
use App\StorageModel;
use App\WholesaleSellsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
        $sells = SellsModel::all('created_at', 'summa')->groupBy(function ($date) {

            return Carbon::parse($date->created_at)->format('Y-m-d'); // групирую по дням

        });

        // график продаж
        $r_sells = SellsModel::all('created_at', 'summa');

        $r_sells = $r_sells->map(function ($item) {

            $item->r_summa = $item->summa;

            return $item;
        });

        $w_sells = WholesaleSellsModel::all('created_at', 'summa');

        $w_sells = $w_sells->map(function ($item) {

            $item->w_summa = $item->summa;

            return $item;
        });

        $all_sale = new Collection();
        $all_sale = $all_sale->merge($r_sells)->merge($w_sells);

        $all_sale = $all_sale->groupBy(function ($date) {

            return Carbon::parse($date->created_at)->format('Y-m-d'); // групирую по дням

        });


        $sells = $sells->map(function ($item) {
            $item = $item->sum('summa');
            return $item;
        });

        $all_sale = $all_sale->map(function ($item) {
            //dump($item);
            $item['r_sell'] = $item->sum('r_summa');
            $item['w_sell'] = $item->sum('w_summa');
            $item['sell'] = $item->sum('summa');
            return $item;
        });


        //dd($all_sale);
        $bills = BillModel::all();


        return view('home')
            ->with(['storages' => $storages])
            ->with(['sells' => $all_sale]);
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
