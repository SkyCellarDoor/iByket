<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvidersModel extends Model
{
    protected $table = 'company';

    public function type_company_model()
    {
        return $this->hasOne('App\TypeCompanyModel',  'id', 'type');
    }

}
