<?php

namespace App\Http\Controllers;

use App\BillModel;
use App\CategorySpendModel;
use App\SpendModel;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CostsController extends Controller
{
    public function index() {

        $all_bills = BillModel::all();


        $cats = CategorySpendModel::where('sub_cat', 0)->get();

        //сегодняшня дата с часами и минутами
        $fromDate = new Carbon('now');
        // обрезаем минуты и приклеиваем начало дня 00:00:00
        $now_day = $fromDate->toDateString()." 00:00:00";
        //сегодняшня дата с часами и минутами
        $toDate = new Carbon('now');


        $spends = SpendModel::whereBetween('created_at', [$now_day, $toDate])->orderBy('created_at', 'desc')->get();

        //dd($spends);

        return view('costs.costs')
            ->with(['spends' => $spends])
            ->with(['bills' => $all_bills])
            ->with(['cats' => $cats]);
    }

    public function new_cost(Request $request) {



        $spend = new SpendModel();
        $spend -> category = $request -> category;
        $spend -> 	bill   = $request -> bill;
        $spend -> comments = $request -> comments;
        $spend -> value    = '-'.$request -> value;
        $spend -> user_id  = Auth::id();
        $spend -> file     = '-';
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

    public function sub_cat(Request $request)
    {
        $search_sub_cat = $request -> category;
        $sub_cats = CategorySpendModel::where('sub_cat', $search_sub_cat)->get();

        $result = view('costs.sub_cat_result')->with(['sub_cats' => $sub_cats])->render();

        return $result;
    }


}
