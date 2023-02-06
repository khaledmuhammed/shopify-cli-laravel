<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public function getAuthAttribute()
    {
        return Session::get('auth', null);
    }

    public function setAuthAttribute($value)
    {
        Session::put('auth', $value);
    }
}
