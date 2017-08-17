<?php

namespace App\Http\Controllers;

use App\CostRetailModel;
use App\Goods;
use App\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public function product(Request $request) {


        $search = $request->q;

        $good = Goods::where('name','like', '%'.$search.'%')->get();

        $good_id = $good->pluck('id')->toArray();


        $results = ProductModel::whereIn('good_id', $good_id)
            ->where('storage_id', Auth::user()->storage_id)
            ->where(function ($query) {
                $query->where('amount', '>=', 1)
                      ->orWhere('consist_amount', '>=', 1);
            })
            ->where(function ($query) {
                $query->where('one_cost_sell_id', '>=', 1)
                    ->orWhere('many_cost_sell_id', '>=', 1);
            })->get(['id', 'good_id', 'amount', 'consist_amount', 'consist_amount_was','one_cost_sell_id', 'many_cost_sell_id', 'created_at']);


        $results->map(function ($item) {

            $good = Goods::where('id', $item['good_id'])->first();

            $name = $good->name;

            if ( $good->consist == 0 ) {

                $price = $item->one_cost_retail_model->cost;
                $consist_one = $item->good_model->one_name_model->name_short;

                $item['consist'] = 0;
                $item['price'] = $price;
                $item['consist_name_one'] = $consist_one;
                $item['consist_name_many'] = 0;
                $item['consist_amount_was'] = 0;

            }
            else {

                $price = $item -> many_cost_retail_model->cost;
                $consist_one = $item->good_model->one_name_model->name_short;
                $consist_many = $item->good_model->many_name_model->name_short;

                $item['consist'] = 1;
                $item['price'] = $price;
                $item['consist_name_one'] = $consist_one;
                $item['consist_name_many'] = $consist_many;

            }

            $item['name'] = $name;
            //dump($item);

        });

        return "{\"items\":".$results."}";

    }

    public function product_wholesale(Request $request)
    {


        $search = $request->q;

        $good = Goods::where('name', 'like', '%' . $search . '%')->get();

        $good_id = $good->pluck('id')->toArray();


        $results = ProductModel::whereIn('good_id', $good_id)
            ->where('storage_id', Auth::user()->storage_id)
            ->where(function ($query) {
                $query->where('amount', '>=', 1)
                    ->orWhere('consist_amount', '>=', 1);
            })
            ->where(function ($query) {
                $query->where('one_cost_sell_opt_id', '>=', 1)
                    ->orWhere('many_cost_sell_opt_id', '>=', 1);
            })->get(['id', 'good_id', 'amount', 'consist_amount', 'consist_amount_was', 'one_cost_sell_opt_id', 'many_cost_sell_opt_id', 'created_at']);


        $results->map(function ($item) {

            $good = Goods::where('id', $item['good_id'])->first();

            $name = $good->name;

            if ($good->consist == 0) {

                $price = $item->one_cost_wholesale_model->cost;
                $consist_one = $item->good_model->one_name_model->name_short;

                $item['consist'] = 0;
                $item['price'] = $price;
                $item['consist_name_one'] = $consist_one;
                $item['consist_name_many'] = 0;
                $item['consist_amount_was'] = 0;

            } else {

                $price = $item->one_cost_wholesale_model->cost;
                $consist_one = $item->good_model->one_name_model->name_short;
                $consist_many = $item->good_model->many_name_model->name_short;

                $item['consist'] = 1;
                $item['price'] = $price;
                $item['consist_name_one'] = $consist_one;
                $item['consist_name_many'] = $consist_many;

            }

            $item['name'] = $name;
            //dump($item);

        });

        return "{\"items\":" . $results . "}";

    }

    public function good(Request $request) {

        $search = $request->q;

        $results = Goods::where('name','like', '%'.$search.'%')->get();

        return "{\"items\":".$results."}";

    }
}
