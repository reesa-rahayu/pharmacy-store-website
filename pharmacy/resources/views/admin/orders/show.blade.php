<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-4">{{ __('Order ID:') }} {{ $order->id }}</h1>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">{{ __('Customer Information') }}</h3>
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <p><strong class="text-gray-700 dark:text-gray-300">{{ __('Name:') }}</strong> <span
                                    class="text-gray-900 dark:text-gray-100">{{ $order->user->name }}</span></p>
                            <p><strong class="text-gray-700 dark:text-gray-300">{{ __('Email:') }}</strong> <span
                                    class="text-gray-900 dark:text-gray-100">{{ $order->user->email }}</span></p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">{{ __('Order Items') }}</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-600">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            {{ __('Product Name') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            {{ __('Quantity') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            {{ __('Price') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            {{ __('Subtotal') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-700">
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ $item->product->name }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ $item->quantity }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6">
                        <p class="text-xl font-semibold">{{ __('Total Amount:') }} <span
                                class="text-indigo-600 dark:text-indigo-400">Rp
                                {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
                        <p><strong>{{ __('Status:') }}</strong> <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $order->status === 'completed'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($order->status === 'pending'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : ($order->status === 'shipped'
                                                            ? 'bg-blue-100 text-blue-800'
                                                            : 'bg-gray-100 text-gray-800')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p><strong>{{ __('Order Date:') }}</strong> {{ $order->created_at }}</p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('admin.orders.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-300 focus:bg-gray-700 dark:focus:bg-gray-300 active:bg-gray-900 dark:active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Back to Orders') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
