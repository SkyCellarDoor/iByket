<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShiftModel extends Model
{
    protected $table = 'shifts';

    public function scopeOpenShift($query)
    {
            // получение времени открытой смены этого пользователя
        return $query->where('storage_id', Auth::user()->storage_id)->where('status', false);
    }

    public function scopeLastShift($query)
    {
        // получение времени открытой смены этого пользователя
        return $query->where('storage_id', Auth::user()->storage_id)->where('status', true)->orderBy('created_at', 'desc');
    }

}
