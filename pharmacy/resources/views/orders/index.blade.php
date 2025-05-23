<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight text-center">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            @if ($orders->isEmpty())
                <p class="text-gray-600">You have no orders yet.</p>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div class="border p-4 rounded-md">
                            <h3 class="font-bold">Order #{{ $order->id }}</h3>
                            <p>Status: <span class="text-sm text-gray-700">{{ $order->status }}</span></p>
                            <p>Total: ${{ number_format($order->total_amount, 2) }}</p>
                            <p>Date: {{ $order->created_at->format('d M Y') }}</p>
                            <a href="{{ route('orders.show', $order) }}" class="text-blue-500 hover:underline">View
                                Details</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
