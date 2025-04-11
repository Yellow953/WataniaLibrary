<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return  Order::all()->map(function ($order) {
            return [
                'user' => $order->cashier->name ?? $order->client->name,
                'order_number' => $order->order_number,
                'sub_total' => $order->sub_total,
                'tax' => $order->tax,
                'discount' => $order->discount,
                'total' => $order->total,
                'products_count' => $order->product_count,
                'note' => $order->note,
                'created_at' => $order->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'User',
            'Order Number',
            'Sub Total',
            'Tax',
            'Discount',
            'Total',
            'Products Count',
            'Note',
            'Created At',
        ];
    }
}
