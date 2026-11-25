<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Struk Transaksi</h2>
    </x-slot>

    <style>
        @media print {
            @page {
                size: 58mm 200mm;
                margin: 0;
            }

            nav,
            header,
            .no-print {
                display: none !important;
            }

            html,
            body {
                width: 58mm;
                margin: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
            }

            .struk-page,
            .struk-wrapper {
                width: 58mm !important;
                max-width: 58mm !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .struk-area {
                width: 58mm !important;
                margin: 0 !important;
                padding: 3mm !important;
                border: 0 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                font-family: 'Courier New', monospace !important;
                font-size: 9pt !important;
                line-height: 1.3 !important;
                color: #000000 !important;
            }

            .struk-area * {
                color: #000000 !important;
                font-size: inherit !important;
            }
        }
    </style>

    <div class="py-8 struk-page">
        <div class="max-w-md mx-auto sm:px-6 struk-wrapper">
            <x-card class="struk-area">
                <p class="text-center font-semibold">POS Barokah Mart</p>
                <p class="text-center text-xs text-gray-500 mb-3">{{ $transaction->invoice_number }}</p>

                <p class="text-xs text-gray-500 mb-3">
                    {{ $transaction->created_at->format('d M Y H:i') }} &middot; Kasir: {{ $transaction->user->name }}
                </p>

                <hr class="mb-3">

                @foreach ($transaction->details as $detail)
                    <div class="flex justify-between text-sm mb-1">
                        <span>{{ $detail->product->name }} x{{ $detail->qty }}</span>
                        <span>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <hr class="my-3">

                <div class="flex justify-between font-semibold">
                    <span>Total</span>
                    <span>Rp{{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span>Bayar</span>
                    <span>Rp{{ number_format($transaction->pay, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between text-sm">
                    <span>Kembali</span>
                    <span>Rp{{ number_format($transaction->change, 0, ',', '.') }}</span>
                </div>

                <button type="button" onclick="window.print()"
                    class="no-print block w-full text-center mt-4 bg-gray-700 text-white py-2 rounded-md">
                    Cetak Struk
                </button>

                <a href="{{ route('pos.index') }}"
                    class="no-print block text-center mt-4 bg-indigo-600 text-white py-2 rounded-md">
                    Transaksi Baru
                </a>
            </x-card>
        </div>
    </div>
</x-app-layout>
