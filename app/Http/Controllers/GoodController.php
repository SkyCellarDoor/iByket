<?php

namespace App\Http\Controllers;

use App\CategoryGoodModel;
use App\Goods;
use App\ProductModel;
use App\SellsProductsModel;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function update (Request $request){

        if($request->ajax()){

            if (!isset($request->sub_category) ){
                $category = $request->category;
            }
            else
                $category = $request->sub_category;

            $id = $request -> id;
            $good = Goods::find($id);
            $good -> category_good_id = $category;
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

        $list_products = ProductModel::where('good_id', $id)->with(
            'storage_model',
            'invoice_model',
            'storage_box_model',
            'good_model.one_name_model',
            'good_model.many_name_model')->get()->sortBy('good_id')->take(7);

        //dd($products);

        $all_product = ProductModel::where('good_id', $id)->get()->pluck('id');

        $sells = SellsProductsModel::whereIN('product_id', $all_product)->get();

        $product = Goods::with('categories_model')->find($id);

        $categories = CategoryGoodModel::where('main', NULL)->get();

        if ($product->categories_model->main == null){
            $sub_categories = CategoryGoodModel::where('main', $product->categories_model->id)->get();
        }
        else {
            $sub_categories = CategoryGoodModel::where('main', $product->categories_model->main)->get();
        }
        $product_count = $list_products->sum('amount');



        return view('products.product_detail')
            ->with(['sells'=> $sells])
            ->with(['categories'=> $categories])
            ->with(['sub_categories'=> $sub_categories])
            ->with(['list_products'=>  $list_products])
            ->with('product', $product)
            ->with('product_count', $product_count);

    }

    public function sub_cat(Request $request) {
        $search_sub_cat = $request -> category;
        $sub_cats = CategoryGoodModel::where('main', $search_sub_cat)->get();

        $result = view('products.sub_cat_good_result')->with(['sub_cats' => $sub_cats])->render();

        return $result;
    }

    public function list_goods () {

        $goods = Goods::all();

        return view('products.list_goods')->with(['goods' => $goods]);

    }

}
