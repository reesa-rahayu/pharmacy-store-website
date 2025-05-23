<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="md:flex md:items-start md:space-x-4">
                        <div class="mb-4 md:mb-0">
                            @if ($product->image)
                                <img src="{{ $product->image}}" alt="{{ $product->name }}"
                                    class="w-full max-w-md rounded-lg shadow-md">
                            @else
                                <div
                                    class="w-full max-w-md bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center h-48">
                                    <svg class="w-16 h-16 text-gray-500 dark:text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $product->description }}</p>

                            <p class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <p class="text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('Category:') }}
                                <span class="font-semibold">{{ $product->category->name ?? '-' }}</span>
                            </p>

                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                {{ __('Availability:') }}
                                @if ($product->stock > 0)
                                    <span class="text-green-500 font-semibold">{{ __('In Stock') }}
                                        ({{ $product->stock }}
                                        {{ __('available') }})</span>
                                @else
                                    <span class="text-red-500 font-semibold">{{ __('Out of Stock') }}</span>
                                @endif
                            </p>

                            <div class="flex items-center space-x-2 mb-4">
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-indigo-500 dark:hover:bg-indigo-400 focus:bg-indigo-500 dark:focus:bg-indigo-400 active:bg-indigo-700 dark:active:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        {{ __('Add to Cart') }}
                                    </button>
                                </form>
                                <a href="{{ route('products.index') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-300 focus:bg-gray-700 dark:focus:bg-gray-300 active:bg-gray-900 dark:active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    {{ __('Back to Products') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
