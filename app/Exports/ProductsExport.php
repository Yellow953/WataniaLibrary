<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Product::with('category')->filter()->get()->map(function ($product) {
            return [
                'category' => $product->category->name,
                'name' => $product->name,
                'quantity' => $product->quantity,
                'cost' => $product->cost,
                'price' => $product->price,
                'description' => $product->description,
                'reference' => $product->reference,
                'group' => $product->group,
                'brand' => $product->brand,
                'public' => $product->public,
                'created_at' => $product->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Category',
            'Name',
            'Quantity',
            'Cost',
            'Price',
            'Description',
            'Reference',
            'Group',
            'Brand',
            'Public',
            'Created At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->category->name,
            $row->name,
            $row->quantity,
            $row->cost,
            $row->price,
            $row->description,
            $row->reference,
            $row->group,
            $row->brand,
            $row->public ? 'Yes' : 'No',
            $row->created_at,
        ];
    }
}
