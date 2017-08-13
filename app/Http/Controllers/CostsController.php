<?php

namespace App\Http\Controllers;

use App\BillModel;
use App\CashRoutesModel;
use App\CategorySpendModel;
use App\CategorySubSpend;
use App\MoveMoneyModel;
use App\SpendModel;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CostsController extends Controller
{
    public function index() {

        $all_bills = BillModel::all();

        //сегодняшня дата с часами и минутами
        $fromDate = new Carbon('now');
        // обрезаем минуты и приклеиваем начало дня 00:00:00
        $now_day = $fromDate->toDateString()." 00:00:00";
        //сегодняшня дата с часами и минутами
        $toDate = new Carbon('now');


        $spends = SpendModel::all();

        //dd($spends);

        return view('costs.costs')
            ->with(['spends' => $spends])
            ->with(['bills' => $all_bills]);
    }

    public function new_cost(Request $request) {

        //dd($request);

        $spend = new SpendModel();
        $spend -> category = $request -> category;
        $spend->sub_category = $request->subcategory;
        $spend->bill = $request->bill;
        $spend -> comments = $request -> comments;
        $spend -> value    = '-'.$request -> value;
        $spend -> user_id  = Auth::id();
        $spend->file = NULL;
        $spend -> save();

        $id_file = $spend->id;


        if (Input::file('spend_doc') != NULL) {

            $ext = Input::file('spend_doc')->getClientOriginalExtension();
            $file_name = 'spends_' . $id_file . '.jpg';

            Image::make(Input::file('spend_doc'))->encode('jpg', 80)->save('img/spends/' . $file_name);

            $file_info = SpendModel::find($id_file);
            $file_info->file = $file_name;
            $file_info->save();

        }

        return redirect()->route('costs');
    }

    public function sub_cat_spends(Request $request)
    {
        $search_sub_cat = $request -> category;

        $sub_cats = CategorySubSpend::where('main_category', $search_sub_cat)->get();

        return view('costs.sub_cat_result')->with(['sub_cats' => $sub_cats])->render();

    }

    public function create_spends()
    {

        $cats = CategorySpendModel::all();
        $bills = BillModel::all();

        return view('costs.create_cost')
            ->with(['bills' => $bills])
            ->with(['cats' => $cats]);

    }

    public function count_max(Request $request)
    {

        $id = $request->bill;

        $operation = CashRoutesModel::where('bill', $id)->get();
        $spend = SpendModel::where('bill', $id)->get();
        $move = MoveMoneyModel::where('bill', $id)->get();

        $all = new Collection();

        $all = $all->merge($move)->merge($spend)->merge($operation);

        $sum = $all->sum('value');

        return $sum;

    }


}
