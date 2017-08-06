<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_invoices_list extends Model
{
    protected $table = 'invoices';

    public function rel_provider_id()
    {
        return $this->hasOne('App\User', 'id', 'provider_id');
    }
}
