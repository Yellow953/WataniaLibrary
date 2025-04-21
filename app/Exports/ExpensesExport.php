<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpensesExport implements FromCollection
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Expense::select('number', 'date', 'category', 'description', 'amount', 'created_at')->filter()->get();
    }

    public function headings(): array
    {
        return [
            'NO',
            'Date',
            'Category',
            'Description',
            'Amount',
            'Created At',
        ];
    }
}
