<?php

namespace App\Http\Controllers;

use App\MoveProductItemModel;
use App\MoveProductsModel;
use App\ProductModel;
use App\SellsProductsModel;
use App\StorageModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index($storage = NULL)
    {

        // жадная загрузка отношений
        $products = ProductModel::with(
            'storage_model',
            'invoice_model',
            'storage_box_model',
            'good_model.one_name_model',
            'good_model.many_name_model')
            ->where('amount', '>', 0)
            ->get()->sortBy('good_id');

        if ($storage != NULL) {
            $products = $products->where('storage_id', $storage);
        }

        return view('products.products')->with(['products' => $products]);
    }
    public function detail_product($id){

        $product = ProductModel::with(
            'good_model.one_name_model',
            'good_model.many_name_model',
            'storage_box_model'
        )->find($id);



        return view('products.product_detail')
            ->with('product', $product);
        //dd($product);
    }

    public function move_product(Request $request){

        $back_url = $request -> back_url;

        $data_product = $request -> id_product;

        $products = ProductModel::whereIn('id', $data_product)->get();

        $stores = StorageModel::where('id','!=',0)->where('id','!=',Auth::user()->storage_id)->get();

        return view('products.move_product')
            ->with(['products' => $products])
            ->with(['stores' => $stores])
            ->with('back_url', $back_url);
        //dd($product);
    }

    public function move_product_create(Request $request){

        $new_move = new MoveProductsModel();
        $new_move -> from_storage = Auth::user()->storage_id;
        $new_move -> to_storage = $request->storage_to;
        $new_move -> complete = false;
        $new_move -> back_products = false;
        $new_move -> user_id = Auth::id();
        $new_move -> save();

        $id_product = $request -> id_product;
        $value_one = $request -> value_one;
        $value_many = $request -> value_many;

        foreach ($id_product as $key => $value){

            $product_minus = ProductModel::find($value);
            $product_minus -> amount = $product_minus -> amount - $value_one[$key];
            $product_minus -> consist_amount = $product_minus -> consist_amount - $value_many[$key];
            $product_minus -> save();

            $product_moved_add = new MoveProductItemModel();
            $product_moved_add -> product_id = $value;
            $product_moved_add -> move_id = $new_move->id;
            $product_moved_add -> value_one = $value_one[$key];
            $product_moved_add -> value_one_was = $value_one[$key];
            $product_moved_add -> value_many = $value_many[$key];
            $product_moved_add -> value_many_was = $value_many[$key];
            $product_moved_add -> save();
        }

        return redirect()->route('move_products_list');
        //dd($product);
    }

    public function move_products_list () {

        $items = MoveProductsModel::all();

        $new = MoveProductsModel::where('complete', 0)->where('back_products', '=', 0)->get();

        $back_product = MoveProductsModel::where('complete', 0)->where('back_products', '>', 0)->get();

        $complete = MoveProductsModel::where('complete', 1)->get();

        return view('products.move_products_list')
            ->with(['items' => $items])
            ->with(['new' => $new])
            ->with(['back_product' => $back_product])
            ->with(['complete' => $complete]);
    }

    public function move_products_detail ($id) {

        $detail = MoveProductsModel::find($id);
        $items = MoveProductItemModel::where('move_id', $id)->get();

        return view('products.move_product_detail')->with('detail', $detail)->with(['items' => $items]);
    }

    public function income_move_product () {

        $items = MoveProductsModel::where('complete', 0)
            ->where('to_storage', Auth::user()->storage_id)
            ->where('back_products', '=', 0)->get();

        $back_product = MoveProductsModel::where('complete', 0)
            ->where('to_storage', Auth::user()->storage_id)
            ->where('back_products', '>', 0)->get();

        return view('products.move_income')
            ->with(['items' => $items])
            ->with(['back_product' => $back_product]);

    }

    public function income_move_detail ($id) {

        $detail = MoveProductsModel::find($id);
        $items = MoveProductItemModel::where('move_id', $id)->get();


        return view('products.move_income_detail')->with(['items' => $items])->with('detail', $detail);
    }

    public function income_move_complete (Request $request) {

        $this_storage = Auth::user()->storage_id;

        $id = $request ->id;
        $value_in = $request -> value_in;
        $value_real = $request -> value;
        $id_invoice = $request -> move_income;
        $from_storage = $request -> from_storage;

        if ($value_in != $value_real){

            $move_products_back = new MoveProductsModel();
            $move_products_back -> from_storage = $this_storage;
            $move_products_back -> to_storage = $from_storage;
            $move_products_back -> complete = false;
            $move_products_back -> back_products = $id_invoice;
            $move_products_back -> user_id = Auth::id();
            $move_products_back -> save();
        }

        foreach ($id as $key => $value) {

            $product_moved = MoveProductItemModel::find($value);
            $product_moved -> value_one =  $product_moved -> value_one - $value_real[$key];



            if($value_real[$key] != $value_in[$key]){

                $back_item = new MoveProductItemModel();
                $back_item -> move_id = $move_products_back -> id;
                $back_item -> product_id = $product_moved -> product_id;
                $back_item -> value_one =  $value_in[$key] - $value_real[$key];
                $back_item -> value_one_was = $value_real[$key] - $value_in[$key];
                $back_item -> value_many = $product_moved -> value_many;
                $back_item -> value_many_was = $product_moved -> value_many_was;
                $back_item -> save();
            }

            $product_moved -> save();


            $product = ProductModel::find($product_moved -> product_id);


            // проверяем принадлежит ли товар скаладу пользователя
            // если да, то прибавляем к количесву, если нет, то создаем копию
            // товара с новым количесвом

            $product_original =  ProductModel::where([
                ['id', '=', $product -> consist_id],
                ['consist_id', '=', NULL ],
                ['storage_id', '=',  $this_storage],
            ])->first();

            $product_original_other_storage =  ProductModel::where([
                ['consist_id', '=', $product_moved -> product_id],
                ['storage_id', '=',  $this_storage],
            ])->first();

            if ( $product_original != NULL && $product -> consist_id != NULL) {

                dump($product_original);
                $product_original -> amount = $product_original -> amount + $value_real[$key];
                $product_original -> save();

            }
            elseif ($product_original_other_storage != NULL){
                dump($product_original_other_storage);

                $product_original_other_storage -> amount = $product_original_other_storage -> amount + $value_real[$key];
                $product_original_other_storage -> save();
            }

            else {

                $new_product = new ProductModel();
                $new_product = $product -> replicate();
                $new_product -> consist_id = $product_moved -> product_id;
                $new_product -> amount = $value_real[$key];
                $new_product -> storage_id = $this_storage;
                $new_product -> user_id = Auth::id();
                $new_product -> save();

            }


        }

        $complete = MoveProductsModel::find($id_invoice);
        $complete -> user_take = Auth::id();
        $complete -> time_take = Carbon::now();
        $complete -> complete = true;
        $complete -> save();


        return redirect()->route('income_move_product');
    }
}
