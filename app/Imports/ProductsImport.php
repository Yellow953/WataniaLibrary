<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithBatchInserts
{
    public function model(array $row)
    {
        $category = Category::firstOrCreate(
            ['name' => $row['category']],
            [
                'image' => 'assets/images/no_img.png'
            ]
        );

        return new Product([
            'category_id' => $category->id,
            'name' => $row['name'] ?? 1,
            'quantity' => $row['quantity'] ?? 0,
            'cost' => $row['cost'] ?? 0,
            'price' => $row['price'] ?? 0,
            'reference' => $row['reference'] ?? '',
            'group' => $row['group'] ?? '',
            'brand' => $row['brand'] ?? '',
            'description' => $row['description'] ?? '',
            'public' => true,
            'image' => 'assets/images/no_img.png',
        ]);
    }

    public function chunkSize(): int
    {
        return 50;
    }

    public function batchSize(): int
    {
        return 50;
    }
}
