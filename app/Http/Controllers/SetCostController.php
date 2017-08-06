<?php

namespace App\Http\Controllers;

use App\CostRetailModel;
use App\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetCostController extends Controller
{
    public function set_cost_complete(Request $request){

        $id_products = $request-> id_product;
        $price_one = $request -> new_price_one;
        $price_many = $request -> new_price_many;
        $back_url = $request->back_url;

        foreach ($id_products as $id => $value) {

            $product = ProductModel::find($value);

            $last_cost_one = $product->LastCostOne();
            $last_cost_many = $product->LastCostMany();

            if ( is_null($last_cost_one) ) {

                $new_price = new CostRetailModel();
                $new_price->product_id = $product->id;
                $new_price->good_id = $product->good_id;
                $new_price->type = 1;
                $new_price->cost = $price_one[$id];
                $new_price->user_id = Auth::id();
                $new_price->save();

                $product->one_cost_sell_id = $new_price->id;
                $product->save();

            }

            elseif( is_null( $last_cost_many ) && !is_null($price_many[$id])) {

                $new_price = new CostRetailModel();
                $new_price->product_id = $product->id;
                $new_price->good_id = $product->good_id;
                $new_price->type = 0;
                $new_price->cost = $price_many[$id];
                $new_price->user_id = Auth::id();
                $new_price->save();

                $product->many_cost_sell_id = $new_price->id;
                $product->save();

            } else {
                if ($last_cost_one->cost == $price_one[$id]) {

                    $product->one_cost_sell_id = $last_cost_one->id;
                    $product->save();
                } else {

                    $new_price = new CostRetailModel();
                    $new_price->product_id = $product->id;
                    $new_price->good_id = $product->good_id;
                    $new_price->type = 1;
                    $new_price->cost = $price_one[$id];
                    $new_price->user_id = Auth::id();
                    $new_price->save();

                    $product->one_cost_sell_id = $new_price->id;
                    $product->save();
                }

                if (!is_null($price_many[$id])) {

                    if ( $last_cost_many->cost == $price_many[$id]) {

                        $product->many_cost_sell_id =  $last_cost_many->id;
                        $product->save();
                    } else {

                        $new_price = new CostRetailModel();
                        $new_price->product_id = $product->id;
                        $new_price->good_id = $product->good_id;
                        $new_price->type = 0;
                        $new_price->cost = $price_many[$id];
                        $new_price->user_id = Auth::id();
                        $new_price->save();

                        $product->many_cost_sell_id = $new_price->id;
                        $product->save();

                    }
                }
            }
        }

        return redirect()->route($back_url);
    }

    public function set_cost(Request $request){

        if( $request->id_product == null){

            return back();
        }

        $data_product = $request->id_product;

        $back_url = $request->back_url;

        $products = ProductModel::whereIn('id', $data_product)->get();

        return view('price.set_price')->with(['products' => $products])->with('back_url', $back_url);

    }
}
