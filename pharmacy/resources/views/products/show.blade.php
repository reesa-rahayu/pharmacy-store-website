<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            @if ($product->image)
                                <img src="{{ $product->image}}" alt="{{ $product->name }}"
                                    class="w-full rounded-lg shadow-md">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400">No image</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                            <p class="text-gray-600 mt-4">{{ $product->description }}</p>

                            <div class="mt-6">
                                <span
                                    class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                <span class="text-sm text-gray-500 ml-2">In Stock: {{ $product->stock }}</span>
                            </div>

                            @auth
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6">
                                    @csrf
                                    <div class="flex items-center">
                                        <input type="number" name="quantity" value="1" min="1"
                                            max="{{ $product->stock }}"
                                            class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <button type="submit"
                                            class="ml-4 bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition duration-150">
                                            Add to Cart
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="mt-6">
                                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600">Login to
                                        purchase</a>
                                </div>
                            @endauth
                        </div>

                    </div>
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900">Ratings & Reviews</h3>

                        {{-- Overall Rating --}}
                        <div class="flex items-center mt-2">
                            @php
                                $avgRating = $product->averageRating();
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $avgRating ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">{{ $avgRating }}/5</span>
                            <span class="ml-1 text-sm text-gray-500">({{ $product->ratings->count() }}
                                reviews)</span>
                        </div>

                        {{-- Individual Reviews --}}
                        <div class="mt-4">
                            @foreach ($product->ratings as $rating)
                                <div class="border-b border-gray-200 py-4">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="text-sm text-gray-500 ml-2">{{ $rating->user->name }}</span>
                                    </div>
                                    <p class="mt-2 text-gray-600">{{ $rating->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
