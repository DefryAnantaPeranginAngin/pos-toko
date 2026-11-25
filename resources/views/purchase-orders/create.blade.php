<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Pembelian Stok Baru</h2>
    </x-slot>

    <div class="py-8" x-data="poForm()">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <form action="{{ route('purchase-orders.store') }}" method="POST" class="space-y-4">
                    @csrf

                    @if ($errors->any())
                        <div class="p-3 bg-red-100 text-red-700 rounded-md text-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Supplier</label>
                            <select name="supplier_id" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="">-- Pilih Supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @selected(old('supplier_id') == $supplier->id)>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date"
                                value="{{ old('purchase_date', now()->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300">
                        </div>
                    </div>

                    <table class="min-w-full text-sm">
                        <thead>
                            <tr>
                                <th class="px-2 py-2 text-left">Produk</th>
                                <th class="px-2 py-2 text-left w-24">Qty</th>
                                <th class="px-2 py-2 text-left w-36">Harga Beli</th>
                                <th class="px-2 py-2 text-right w-36">Subtotal</th>
                                <th class="w-8"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(item, index) in items" :key="index">
                                <tr>
                                    <td class="px-2 py-1">
                                        <select :name="'items[' + index + '][product_id]'" x-model="item.product_id"
                                            class="w-full rounded-md border-gray-300">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="number" min="1" :name="'items[' + index + '][qty]'"
                                            x-model.number="item.qty" class="w-full rounded-md border-gray-300">
                                    </td>
                                    <td class="px-2 py-1">
                                        <input type="number" min="1" :name="'items[' + index + '][cost_price]'"
                                            x-model.number="item.cost_price" class="w-full rounded-md border-gray-300">
                                    </td>
                                    <td class="px-2 py-1 text-right" x-text="formatRupiah(item.qty * item.cost_price)">
                                    </td>
                                    <td class="px-2 py-1">
                                        <button type="button" @click="removeRow(index)"
                                            class="text-red-500">&times;</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <button type="button" @click="addRow()" class="text-sm text-indigo-600">+ Tambah Baris</button>

                    <div class="flex justify-between font-semibold border-t pt-3">
                        <span>Total Pembelian</span>
                        <span x-text="formatRupiah(total())"></span>
                    </div>

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">
                        Simpan Pembelian
                    </button>
                </form>
            </x-card>
        </div>
    </div>

    @push('scripts')
        @php
            $itemsAwal = old('items', [['product_id' => '', 'qty' => 1, 'cost_price' => 0]]);
        @endphp
        <script>
            function poForm() {
                return {
                    items: @json($itemsAwal),
                    addRow() {
                        this.items.push({
                            product_id: '',
                            qty: 1,
                            cost_price: 0
                        });
                    },
                    removeRow(index) {
                        if (this.items.length > 1) this.items.splice(index, 1);
                    },
                    total() {
                        return this.items.reduce((sum, i) => sum + (i.qty * i.cost_price), 0);
                    },
                    formatRupiah(value) {
                        return 'Rp' + Number(value || 0).toLocaleString('id-ID');
                    },
                };
            }
        </script>
    @endpush
</x-app-layout>
