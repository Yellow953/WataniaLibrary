<?php

namespace App\Exports;

use App\Models\Promo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PromoExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Promo::all()->map(function ($promo) {
            return [
                'title' => $promo->title,
                'code' => $promo->code,
                'value' => $promo->value,
                'created_at' => $promo->created_at,
            ];
        });
    }
    public function headings(): array
    {
        return [
            'Title',
            'Code',
            'Value',
            'Created At',
        ];
    }
}
