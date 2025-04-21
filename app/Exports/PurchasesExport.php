<?php

namespace App\Exports;

use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;

class PurchasesExport implements FromCollection
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Purchase::with('supplier')->filter()->get();
    }

    public function headings(): array
    {
        return [
            'NO',
            'Supplier',
            'Purchase Date',
            'Total',
            'Invoice Number',
            'Notes',
            'Created At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->number,
            $row->supplier->name,
            $row->purchase_date,
            $row->total,
            $row->invoice_number,
            $row->notes,
            $row->created_at,
        ];
    }
}
