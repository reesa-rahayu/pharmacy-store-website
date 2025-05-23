<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600 dark:text-green-400">{{ session('success') }}</div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.products.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                    + Add Product
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Image</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Category</th>
                            <th class="px-4 py-2 text-left">Price</th>
                            <th class="px-4 py-2 text-left">Stock</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-t dark:border-gray-700">
                                <td class="px-4 py-2">
                                    @if ($product->image)
                                        <img src="{{ $product->image}}"
                                            class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-500">No Image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-2">{{ $product->stock }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="text-indigo-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
