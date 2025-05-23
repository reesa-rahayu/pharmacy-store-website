<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight text-center">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded p-6">
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf

                <!-- Alamat -->
                <div class="mb-4">
                    <label for="shipping_address" class="block font-medium text-sm text-gray-700">Alamat
                        Pengiriman</label>
                    <textarea name="shipping_address" id="shipping_address" rows="3" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">{{ old('shipping_address', $user->address) }}</textarea>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Payment Method</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="debit_credit_card" required
                                class="mr-2">
                            Debit/Credit Card
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="cod" required class="mr-2">
                            Di tempat
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700 mb-1">Payment Type</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="payment_type" value="pre_paid" required
                                class="mr-2">
                            Pre Paid
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_type" value="post_paid" required class="mr-2">
                            Post Paid
                        </label>
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="mt-6 border-t pt-4">
                    <h3 class="font-semibold text-lg mb-2">Total Pembayaran</h3>
                    @php
                        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
                    @endphp
                    <p><strong>Rp{{ number_format($total, 2) }}</strong></p>
                </div>

                <!-- Tombol Submit -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                        Buat Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
