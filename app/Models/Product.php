<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Profit
    public function get_profit()
    {
        return $this->price - $this->cost;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function secondary_images()
    {
        return $this->hasMany(SecondaryImage::class);
    }

    public function barcodes()
    {
        return $this->hasMany(Barcode::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function can_delete()
    {
        return auth()->user()->role == 'admin' && $this->items->count() == 0;
    }

    // Filter
    public function scopeFilter($q)
    {
        if (request('name')) {
            $name = request('name');
            $q->where('name', 'LIKE', "%{$name}%");
        }
        if (request('category_id')) {
            $category_id = request('category_id');
            $q->where('category_id', $category_id);
        }
        if (request('description')) {
            $description = request('description');
            $q->where('description', 'LIKE', "%{$description}%");
        }
        if (request('reference')) {
            $reference = request('reference');
            $q->where('reference', 'LIKE', "%{$reference}%");
        }
        if (request('group')) {
            $group = request('group');
            $q->where('group', 'LIKE', "%{$group}%");
        }
        if (request('brand')) {
            $brand = request('brand');
            $q->where('brand', 'LIKE', "%{$brand}%");
        }
        if (request('barcode')) {
            $q->whereHas('barcodes', function ($query) {
                $query->where('barcode', 'LIKE', '%' . request('barcode') . '%');
            });
        }

        return $q;
    }
}
