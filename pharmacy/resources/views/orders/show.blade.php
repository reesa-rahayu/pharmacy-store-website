<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight text-center">
            {{ __('Laporan Pesanan') }}
        </h2>
    </x-slot>
    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6 text-sm leading-relaxed">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 mb-6">
                <div>
                    <div>
                        <p><strong>User Id:</strong> {{ $order->user->id }}</p>
                    </div>
                    <div>
                        <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                    </div>
                    <div>
                        <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <p><strong>No HP:</strong> {{ $order->user->phone_number }}</p>
                    </div>
                </div>
                <div>
                    <div>
                        <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                    <div>
                        <p><strong>Metode Pembayaran:</strong>
                            {{ Str::of($order->payment_method)->replace('_', ' ')->title() }}</p>
                    </div>
                    <div>
                        <p><strong>Nama Bank:</strong></p>
                    </div>
                    <div>
                        <p><strong>Cara Bayar:</strong> {{ Str::of($order->payment_type)->replace('_', ' ') }}
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h3 class="text-lg font-semibold mb-2">Rincian Produk</h3>
            <table class="w-full text-left border">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-3">No</th>
                        <th class="py-2 px-3">Produk</th>
                        <th class="py-2 px-3">Qty</th>
                        <th class="py-2 px-3">Harga Satuan</th>
                        <th class="py-2 px-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $loop->iteration }}</td>
                            <td class="py-2 px-3">{{ $item->product->name }}</td>
                            <td class="py-2 px-3">{{ $item->quantity }}</td>
                            <td class="py-2 px-3">Rp{{ number_format($item->price, 2) }}</td>
                            <td class="py-2 px-3">Rp{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-2">
                <strong>Total belanja (termasuk pajak): Rp{{ number_format($order->total_amount, 2) }}</strong>
            </div>

            <div class="flex justify-end">
                <x-application-logo></x-application-logo>
            </div>
        </div>
        <div class="flex justify-end mt-4 gap-4">
            @if ($order->status !== 'shipped')
                <form action="{{ route('orders.cancel', $order) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to cancel this order?');">
                    @csrf
                    <button type="submit"
                        class="btn btn-danger inline-block bg-gray-400 px-4 py-2 text-gray-100 rounded hover:bg-gray-600">Cancel
                        Order</button>
                </form>
            @endif
            <a href="{{ route('orders.download', $order) }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Unduh PDF
            </a>
            <a href="{{ route('orders.email', $order) }}"
                class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Kirim ke Email
            </a>
        </div>
    </div>
</x-app-layout>
