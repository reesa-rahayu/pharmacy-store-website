<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Welcome Message -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}!</h3>
                        <p class="text-gray-600 dark:text-gray-400">Here's an overview of your account</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <!-- Total Orders Card -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">My Orders</h3>
                            <p class="text-3xl font-bold">{{ auth()->user()->orders()->count() }}</p>
                        </div>

                        <!-- Pending Orders Card -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Pending Orders</h3>
                            <p class="text-3xl font-bold">
                                {{ auth()->user()->orders()->where('status', 'pending')->count() }}</p>
                        </div>

                        <!-- Completed Orders Card -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Completed Orders</h3>
                            <p class="text-3xl font-bold">
                                {{ auth()->user()->orders()->where('status', 'completed')->count() }}</p>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Recent Orders</h3>
                            <a href="{{ route('orders.index') }}"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">View
                                All Orders</a>
                        </div>
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-600">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            Order ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            Total</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-600">
                                    @foreach (auth()->user()->orders()->latest()->take(5)->get() as $order)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                #{{ $order->id }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                {{ $order->created_at->format('M d, Y') }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                ${{ number_format($order->total_amount, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $order->status === 'completed'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($order->status === 'pending'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-gray-100 text-gray-800') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <a href="{{ route('orders.show', $order) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">View
                                                    Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('products.index') }}"
                                class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                                <h4 class="text-lg font-semibold mb-2">Browse Products</h4>
                                <p class="text-gray-600 dark:text-gray-400">Shop our latest products</p>
                            </a>
                            <a href="{{ route('profile.edit') }}"
                                class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                                <h4 class="text-lg font-semibold mb-2">Update Profile</h4>
                                <p class="text-gray-600 dark:text-gray-400">Manage your account settings</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
