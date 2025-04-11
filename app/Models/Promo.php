<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $guarded = [];

    // Filter
    public function scopeFilter($q)
    {
        if (request('title')) {
            $title = request('title');
            $q->where('title', 'LIKE', "%{$title}%");
        }
        if (request('code')) {
            $code = request('code');
            $q->where('code', 'LIKE', "%{$code}%");
        }

        return $q;
    }

    public function can_delete()
    {
        return auth()->user()->role == 'admin';
    }
}
