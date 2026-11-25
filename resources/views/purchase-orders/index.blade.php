<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Pembelian Stok</h2>
            <a href="{{ route('purchase-orders.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm">+ Pembelian Baru</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">No. PO</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tanggal</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Supplier</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Total</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($purchaseOrders as $po)
                            <tr>
                                <td class="px-4 py-2 text-sm">{{ $po->po_number }}</td>
                                <td class="px-4 py-2 text-sm">{{ $po->purchase_date->format('d M Y') }}</td>
                                <td class="px-4 py-2 text-sm">{{ $po->supplier->name }}</td>
                                <td class="px-4 py-2 text-sm text-right">Rp{{ number_format($po->total, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-center">
                                    <a href="{{ route('purchase-orders.show', $po) }}"
                                        class="text-indigo-600">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada pembelian stok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $purchaseOrders->links() }}</div>
            </x-card>
        </div>
    </div>
</x-app-layout>
