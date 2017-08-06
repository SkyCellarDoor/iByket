<?php

namespace App\Http\Controllers;

use App\CategoryGoodModel;
use App\CategorySubGood;
use App\Goods;
use App\ProductModel;
use App\SellsProductsModel;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function update (Request $request){

        if($request->ajax()){

            $category = $request->category;

            $sub_category = $request->sub_category;

            $id = $request -> id;
            $good = Goods::find($id);
            $good->category_id = $category;
            $good->sub_category_id = $sub_category;
            $good -> name = $request -> name;
            $good -> description = $request -> description;
            $good -> vendor = $request ->vendor;
            $good -> country = $request ->country;
            $good -> sizeX = $request -> sizeX;
            $good -> sizeY = $request -> sizeY;
            $good -> sizeDi = $request -> sizeZ;
            $good -> save();
        }

    }

    public function detail_product($id) {

        $list_products = ProductModel::where('good_id', $id)
            ->where('amount', '>', 0)
            ->with('good_model',
                'good_model.main_cat',
                'good_model.sub_cat',
                'invoice_model',
                'storage_box_model',
                'good_model.one_name_model',
                'good_model.many_name_model')->get()->sortBy('good_id');

        //dd($products);

        $all_product = ProductModel::where('good_id', $id)->get()->pluck('id');

        $sells = SellsProductsModel::whereIN('product_id', $all_product)->get();

        $product = Goods::with('main_cat', 'sub_cat')->find($id);

        $main_cat = CategoryGoodModel::all();
        $sub_cat = CategorySubGood::where('main_category', $product->category_id)->get();

        $product_count = $list_products->sum('amount');

        return view('products.product_detail')
            ->with(['sells'=> $sells])
            ->with(['categories' => $main_cat])
            ->with(['sub_categories' => $sub_cat])
            ->with(['list_products'=>  $list_products])
            ->with('product', $product)
            ->with('product_count', $product_count);
    }

    public function sub_cat(Request $request) {

        $search_sub_cat = $request -> category;

        $sub_cats = CategorySubGood::where('main_category', $search_sub_cat)->get();

        $result = view('products.sub_cat_good_result')->with(['sub_cats' => $sub_cats])->render();

        return $result;
    }

    public function list_goods () {

        $goods = Goods::all();

        return view('products.list_goods')->with(['goods' => $goods]);

    }

}
