<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TopProductsExport implements FromCollection, WithHeadings, WithTitle
{
    public function __construct(protected $start, protected $end, protected $kasirId = null) {}

    public function collection(): Collection
    {
        return DB::table('transaction_details')
            ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'products.id', '=', 'transaction_details.product_id')
            ->whereBetween('transactions.created_at', [$this->start, $this->end])
            ->when($this->kasirId, fn ($query) => $query->where('transactions.user_id', $this->kasirId))
            ->groupBy('products.id', 'products.name')
            ->selectRaw('products.name AS nama,
                         SUM(transaction_details.qty) AS total_qty,
                         SUM(transaction_details.subtotal) AS total_penjualan')
            ->orderByDesc('total_qty')
            ->get()
            ->map(fn($row, $index) => [
                $index + 1,
                $row->nama,
                $row->total_qty,
                $row->total_penjualan,
            ]);
    }

    public function headings(): array
    {
        return ['Peringkat', 'Nama Produk', 'Qty Terjual', 'Total Penjualan'];
    }

    public function title(): string
    {
        return 'Produk Terlaris';
    }
}
