<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class receivedgoods extends Model {

    protected $table = 'receivedgoods';

    public function rel_good_id (){
        return $this->hasOne('App\Goods', 'id','good_id');
    }
}
