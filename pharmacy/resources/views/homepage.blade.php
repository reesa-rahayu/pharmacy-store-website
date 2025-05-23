<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Toko Alat Kesehatan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                {{-- Welcome Section --}}
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
                        Selamat Datang di Toko Alat Kesehatan!
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Menyediakan alat kesehatan berkualitas untuk kebutuhan Anda.
                    </p>
                </div>

                {{-- Featured Products (Mockup) --}}
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Produk Unggulan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach (range(1, 3) as $i)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <div
                                    class="h-40 bg-gray-200 dark:bg-gray-600 rounded mb-4 flex items-center justify-center text-gray-500 dark:text-gray-300">
                                    Gambar Produk
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Alat Kesehatan
                                    #{{ $i }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 mt-2">Deskripsi singkat produk kesehatan.</p>
                                <div class="mt-4">
                                    <a href="#"
                                        class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- About Section --}}
                <div class="mt-12">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Tentang Kami</h2>
                    <p class="text-gray-600 dark:text-gray-300">
                        Toko Alat Kesehatan adalah penyedia berbagai macam perlengkapan medis, seperti tensimeter,
                        termometer, oksimeter, dan lainnya. Kami berkomitmen untuk menyediakan produk yang aman,
                        berkualitas, dan terjangkau.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
