<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Transaksi Saya</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">No. Invoice</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tanggal</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">Jenis Produk</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Total</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td class="px-4 py-2 text-sm">{{ $transaction->invoice_number }}</td>
                                <td class="px-4 py-2 text-sm">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-2 text-sm text-center">{{ $transaction->details_count }}</td>
                                <td class="px-4 py-2 text-sm text-right">
                                    Rp{{ number_format($transaction->total, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-center">
                                    <a href="{{ route('pos.struk', $transaction) }}" class="text-indigo-600">Lihat
                                        Struk</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
