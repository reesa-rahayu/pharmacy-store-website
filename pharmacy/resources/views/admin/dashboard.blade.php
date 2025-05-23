<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Welcome Message -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-2">Welcome, Admin!</h3>
                        <p class="text-gray-600 dark:text-gray-400">Here's an overview of your store</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                        <!-- Total Products Card -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Total Products</h3>
                            <p class="text-3xl font-bold">{{ \App\Models\Product::count() }}</p>
                            <a href="{{ route('admin.products.index') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Manage
                                Products</a>
                        </div>

                        <!-- Total Orders Card -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Total Orders</h3>
                            <p class="text-3xl font-bold">{{ \App\Models\Order::count() }}</p>
                            <a href="{{ route('admin.orders.index') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">View
                                Orders</a>
                        </div>

                        <!-- Total Users Card -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                            <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
                            <a href="{{ route('admin.customers.index') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">View
                                Customers</a>
                        </div>

                        <!-- Total Revenue Card -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Total Revenue</h3>
                            <p class="text-3xl font-bold">
                                ${{ number_format(\App\Models\Order::sum('total_amount'), 2) }}</p>
                            <a href="{{ route('admin.orders.index') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">View
                                Details</a>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Recent Orders</h3>
                            <a href="{{ route('admin.orders.index') }}"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">View All Orders</a>
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
                                            Customer</th>
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
                                    @foreach (\App\Models\Order::with('user')->latest()->take(5)->get() as $order)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                #{{ $order->id }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                {{ $order->user->name }}</td>
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
                                                <a href="{{ route('admin.orders.show', $order) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">View
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
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('admin.products.create') }}"
                                class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                                <h4 class="text-lg font-semibold mb-2">Add New Product</h4>
                                <p class="text-gray-600 dark:text-gray-400">Create a new product listing</p>
                            </a>
                            <a href="{{ route('admin.categories.index') }}"
                                class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                                <h4 class="text-lg font-semibold mb-2">Manage Categories</h4>
                                <p class="text-gray-600 dark:text-gray-400">Organize your product categories</p>
                            </a>
                            <a href="{{ route('admin.customers.index') }}"
                                class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow hover:shadow-lg transition-shadow">
                                <h4 class="text-lg font-semibold mb-2">Customer Management</h4>
                                <p class="text-gray-600 dark:text-gray-400">View and manage customer accounts</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
