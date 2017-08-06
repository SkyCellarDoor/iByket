<?php

namespace App\Http\Controllers;

use App\PromotionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PromotionController extends Controller
{
    public function new_promotion(Request $request) {

        if($request -> ajax()){

            $id = $request->id;

            if ($request->name) {
                $promotion = new PromotionModel();

                $promotion -> product_id = $id;
                $promotion -> name = $request -> name;
                $promotion -> description = $request -> description;
                $promotion -> percent = $request -> percent;
                $promotion -> on_date = $request -> on_date;
                $promotion -> off_date = $request -> off_date;
                $promotion -> active = 1;
                $promotion -> on_retail = $request -> on_retail;
                $promotion -> on_wholesale = $request -> on_wholesale;
                $promotion -> user_id = Auth::id();

                $promotion -> save();

            }

            if ($request -> stop){

                $promotion_id = $request-> promotion_id;

                $promotion = PromotionModel::find();
            }

            $list_promotions = PromotionModel::where('product_id', $id)->where('active', 1)->get();

            return view('promotion.product_promotion')->with(['list_promotions' => $list_promotions])->render();
        }
    }
}
