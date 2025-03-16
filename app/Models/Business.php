<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function operating_hours()
    {
        return $this->hasMany(OperatingHour::class);
    }

    // Permissions
    public function can_delete()
    {
        return auth()->user()->role == "admin";
    }

    // Filter
    public function scopeFilter($q)
    {
        if (request('type')) {
            $type = request('type');
            $q->where('type', $type);
        }
        if (request('name')) {
            $name = request('name');
            $q->where('name', 'LIKE', "%{$name}%");
        }
        if (request('email')) {
            $email = request('email');
            $q->where('email', 'LIKE', "%{$email}%");
        }
        if (request('phone')) {
            $phone = request('phone');
            $q->where('phone', 'LIKE', "%{$phone}%");
        }
        if (request('address')) {
            $address = request('address');
            $q->where('address', 'LIKE', "%{$address}%");
        }
        if (request('tax_id')) {
            $tax_id = request('tax_id');
            $q->where('tax_id', 'LIKE', "%{$tax_id}%");
        }

        return $q;
    }
}
