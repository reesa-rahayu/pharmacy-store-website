<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            {{ __('Products Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Main Grid: 3 columns for products, 1 column for category selector --}}
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {{-- Products Section (3 columns span) --}}
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <span
                                        class="text-lg font-bold text-gray-900">Rp{{ number_format($product->price, 2) }}</span>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>

                                    <div class="mt-4 flex flex-row w-full gap-2">
                                        <a href="{{ route('products.show', $product) }}"
                                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-150 text-center">View
                                            Details</a>

                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit"
                                                class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-150 text-center">Buy
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>

                {{-- Category Selector (1 column span) --}}
                <div class="mb-6">
                    <form action="{{ route('products.index') }}" method="GET"
                        class="bg-white rounded-md p-4 shadow-sm">
                        <fieldset>
                            <legend class="block text-sm font-medium text-gray-700 mb-4">Filter by Category</legend>
                            <div class="flex flex-col gap-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="category" value="" onchange="this.form.submit()"
                                        {{ $categoryId == '' ? 'checked' : '' }}
                                        class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-gray-700">All Categories</span>
                                </label>

                                @foreach ($categories as $category)
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="category" value="{{ $category->id }}"
                                            onchange="this.form.submit()"
                                            {{ $categoryId == $category->id ? 'checked' : '' }}
                                            class="text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                        <span class="ml-2 text-gray-700">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
