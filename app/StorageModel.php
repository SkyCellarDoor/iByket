<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StorageModel extends Model
{
    protected $table = 'storages';

    public function scopeUserStorage ($query) {

        return $query->where('id', Auth::user()->storage_id)->first();
    }
}