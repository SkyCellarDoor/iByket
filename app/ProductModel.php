<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StorageBoxModel;

class ProductModel extends Model
{
    protected $table = 'products';

    public function storage_model()
    {
        return $this->hasOne('App\StorageModel', 'id','storage_id');
    }

    public function good_model()
    {
        return $this->hasOne('App\Goods',  'id', 'good_id');
    }

    public function invoice_model()
    {
        return $this->hasOne('App\InvoicesModel',  'id', 'invoice_id');
    }

    public function storage_box_model()
    {
        return $this->hasOne('App\StorageBoxModel',  'id', 'storage_box_id');
    }

    public function promotion_model()
    {
        return $this->hasOne('App\PromotionModel',  'id', 'promotion_id');
    }


    // розничные цены
    public function one_cost_retail_model()
    {
        return $this->hasOne('App\CostRetailModel',  'id', 'one_cost_sell_id');
    }

    public function many_cost_retail_model()
    {
        return $this->hasOne('App\CostRetailModel', 'id', 'many_cost_sell_id');
    }

    public function all_one_cost_retail_model()
    {
        return $this->hasMany('App\CostRetailModel',  'good_id', 'good_id')->where('type', 1);
    }

    public function all_many_cost_retail_model()
    {
        return $this->hasMany('App\CostRetailModel',  'good_id', 'good_id')->where('type', 0);
    }


    // оптовые цены
    public function one_cost_wholesale_model()
    {
        return $this->hasOne('App\CostWholesaleModel', 'id', 'one_cost_sell_opt_id');
    }

    public function many_cost_wholesale_model()
    {
        return $this->hasOne('App\CostWholesaleModel', 'id', 'many_cost_sell_opt_id');
    }

    public function all_one_cost_wholesale_model()
    {
        return $this->hasMany('App\CostWholesaleModel', 'good_id', 'good_id')->where('type', 1);
    }

    public function all_many_cost_wholesale_model()
    {
        return $this->hasMany('App\CostWholesaleModel', 'good_id', 'good_id')->where('type', 0);
    }


    public function LastCostRetailOne()
    {
        $item = $this->all_one_cost_retail_model->sortByDesc('created_at')->first();

        if ( $item == NULL ){

            $coll = new ProductModel();

            return $coll->forceFill(['cost' => '00.0']);

        }

        else {

            return $item;

        }
    }

    public function LastCostRetailMany()
    {
        $item = $this->all_many_cost_retail_model->sortByDesc('created_at')->first();

        if ($item == NULL) {

            $coll = new ProductModel();

            return $coll->forceFill(['cost' => '00.0']);

        } else {

            return $item;

        }

    }

    public function LastCostWholeOne()
    {
        $item = $this->all_one_cost_wholesale_model->sortByDesc('created_at')->first();

        if ($item == NULL) {

            $coll = new ProductModel();

            return $coll->forceFill(['cost' => '00.0']);

        } else {

            return $item;

        }
    }

    public function LastCostWholeMany()
    {
        $item = $this->all_many_cost_wholesale_model->sortByDesc('created_at')->first();

        if ( $item == NULL ){

            $coll = new ProductModel();

            return $coll->forceFill(['cost' => '00.0']);

        } else {

            return $item;

        }

    }
}
