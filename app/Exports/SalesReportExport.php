<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Export;

class SalesReportExport implements WithMultipleSheets, Export
{
    public function __construct(
        protected $start,
        protected $end,
        protected $kasirId = null,
    ) {}

    public function sheets(): array
    {
        return [
            new SalesExport($this->start, $this->end, $this->kasirId),
            new TopProductsExport($this->start, $this->end, $this->kasirId),
        ];
    }
}
