<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (count($cart) > 0)
                        <div class="space-y-4">
                            <div class="flex justify-between font-semibold text-gray-700 border-b border-gray-300 pb-2">
                                <div class="flex items-center w-1/2">
                                    <span class="w-12">No</span>
                                    <span class="ml-4">Nama Produk</span>
                                </div>
                                <div class="flex items-center space-x-16 w-1/2 justify-end">
                                    <span>Jumlah</span>
                                    <span>Harga</span>
                                    <span>Aksi</span>
                                </div>
                            </div>
                            @foreach ($cart as $index => $details)
                                <div class="flex items-center justify-between border-b border-gray-200 py-4">
                                    <div class="flex items-center w-1/2">
                                        <span class="w-12">{{ $loop->iteration }}</span>
                                        @if (isset($details['image']))
                                            <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}"
                                                class="w-20 h-20 object-cover rounded ml-2">
                                        @else
                                            <div
                                                class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center ml-2">
                                                <span class="text-gray-400">No image</span>
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <h3 class="text-lg font-semibold text-gray-800">{{ $details['name'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-8 w-1/2 justify-end">
                                        <form action="{{ route('cart.update', $index) }}" method="POST"
                                            class="flex items-center space-x-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}"
                                                min="1"
                                                class="w-16 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-center">
                                            <button type="submit" class="text-blue-500 hover:text-blue-600 text-sm">
                                            </button>
                                        </form>
                                        <div class="w-20 text-right">
                                            Rp {{ number_format($details['price'], 2) }}
                                        </div>
                                        <form action="{{ route('cart.remove', $index) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600 text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-8 flex justify-between items-center">
                                <div class="text-xl font-semibold">
                                    Total belanja (termasuk pajak):
                                    Rp
                                    {{ number_format(
                                        array_sum(
                                            array_map(function ($item) {
                                                return $item['price'] * $item['quantity'];
                                            }, $cart),
                                        ),
                                        2,
                                    ) }}
                                </div>
                                <a href="{{ route('orders.checkout') }}"
                                    class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition duration-150">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Your cart is empty</p>
                            <a href="{{ route('products.index') }}"
                                class="mt-4 inline-block text-blue-500 hover:text-blue-600">
                                Continue Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
