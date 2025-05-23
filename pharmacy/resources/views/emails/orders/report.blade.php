<x-mail::message>
    # Laporan Pesanan Anda

    Halo {{ $order->user->name }},

    Berikut adalah laporan pesanan Anda dengan nomor order **#{{ $order->id }}**. Silakan lihat lampiran untuk detail
    lengkap.

    Terima kasih telah berbelanja di Toko Alat Kesehatan.

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
