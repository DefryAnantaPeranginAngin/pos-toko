<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Pembelian Stok</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">{{ session('success') }}</div>
                @endif

                <h3 class="text-lg font-semibold">{{ $purchaseOrder->po_number }}</h3>
                <p class="text-sm text-gray-500 mb-4">
                    {{ $purchaseOrder->purchase_date->format('d M Y') }}
                    &middot; Supplier: {{ $purchaseOrder->supplier->name }}
                    &middot; Dicatat oleh: {{ $purchaseOrder->user->name }}
                </p>

                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                        <tr>
                            <th class="px-3 py-2 text-left">Produk</th>
                            <th class="px-3 py-2 text-right">Qty</th>
                            <th class="px-3 py-2 text-right">Harga Beli</th>
                            <th class="px-3 py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($purchaseOrder->items as $item)
                            <tr>
                                <td class="px-3 py-2">{{ $item->product->name }}</td>
                                <td class="px-3 py-2 text-right">{{ $item->qty }}</td>
                                <td class="px-3 py-2 text-right">Rp{{ number_format($item->cost_price, 0, ',', '.') }}
                                </td>
                                <td class="px-3 py-2 text-right">Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-between font-semibold border-t mt-3 pt-3">
                    <span>Total Pembelian</span>
                    <span>Rp{{ number_format($purchaseOrder->total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('purchase-orders.index') }}" class="inline-block mt-4 text-sm text-indigo-600">
                    &larr; Kembali ke daftar pembelian
                </a>
            </x-card>
        </div>
    </div>
</x-app-layout>
