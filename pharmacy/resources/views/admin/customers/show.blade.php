<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-4">{{ __('Customer Information') }}</h1>

                    <div class="mb-6 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <p><strong class="text-gray-700 dark:text-gray-300">{{ __('ID:') }}</strong> <span
                                class="text-gray-900 dark:text-gray-100">{{ $customer->id }}</span></p>
                        <p><strong class="text-gray-700 dark:text-gray-300">{{ __('Name:') }}</strong> <span
                                class="text-gray-900 dark:text-gray-100">{{ $customer->name }}</span></p>
                        <p><strong class="text-gray-700 dark:text-gray-300">{{ __('Email:') }}</strong> <span
                                class="text-gray-900 dark:text-gray-100">{{ $customer->email }}</span></p>
                        {{-- Add other user details as needed --}}
                    </div>

                    <h2 class="text-xl font-semibold mb-4">{{ __('Customer Orders') }}</h2>

                    @if ($customer->orders->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">{{ __('This customer has no orders yet.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-600">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            {{ __('Order ID') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            {{ __('Total Amount') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            {{ __('Status') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            {{ __('Created At') }}</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">{{ __('Actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-700">
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ $order->id }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ ucfirst($order->status) }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ $order->created_at }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.orders.show', $order) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 hover:dark:text-indigo-300 transition-colors duration-200">{{ __('View Order') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('admin.customers.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-300 focus:bg-gray-700 dark:focus:bg-gray-300 active:bg-gray-900 dark:active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Back to Customers') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
