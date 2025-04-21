<?php

namespace App\Exports;

use App\Models\Promo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PromosExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Promo::filter()->get()->map(function ($promo) {
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
