<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
        }

        .grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .grid div {
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <h3>Toko Alat Kesehatan</h3>
        <h2>Laporan Belanja Anda</h2>
    </div>

    {{-- Informasi Pemesan --}}
    <table
        style="
    width: 100%; 
    margin-bottom: 20px; 
    border-collapse: collapse;
    border: 1px solid white;
    color: #000;">
        <tr>
            <td style="width: 10%; border: 1px solid white; vertical-align: top;"><strong>User Id</strong></td>
            <td style="width: 2%; border: 1px solid white; vertical-align: top;">:</td>
            <td style="width: 18%; border: 1px solid white; vertical-align: top;">{{ $order->user->id }}</td>

            <td style="width: 10%; border: 1px solid white; vertical-align: top;"><strong>Tanggal Pesan</strong></td>
            <td style="width: 2%; border: 1px solid white; vertical-align: top;">:</td>
            <td style="width: 18%; border: 1px solid white; vertical-align: top;">
                {{ $order->created_at->format('d-m-Y H:i') }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid white;"><strong>Nama</strong></td>
            <td style="border: 1px solid white;">:</td>
            <td style="border: 1px solid white;">{{ $order->user->name }}</td>

            <td style="border: 1px solid white;"><strong>Metode Pembayaran</strong></td>
            <td style="border: 1px solid white;">:</td>
            <td style="border: 1px solid white;">{{ Str::of($order->payment_method)->replace('_', ' ')->title() }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid white;"><strong>Alamat</strong></td>
            <td style="border: 1px solid white;">:</td>
            <td style="border: 1px solid white;">{{ $order->shipping_address }}</td>

            <td style="border: 1px solid white;"><strong>Nama Bank</strong></td>
            <td style="border: 1px solid white;">:</td>
            <td style="border: 1px solid white;">-</td>
        </tr>
        <tr>
            <td style="border: 1px solid white;"><strong>No HP</strong></td>
            <td style="border: 1px solid white;">:</td>
            <td style="border: 1px solid white;">{{ $order->user->phone_number }}</td>

            <td style="border: 1px solid white;"><strong>Cara Bayar</strong></td>
            <td style="border: 1px solid white;">:</td>
            <td style="border: 1px solid white;">{{ Str::of($order->payment_type)->replace('_', ' ')->title() }}</td>
        </tr>
    </table>

    {{-- Tabel Produk --}}
    <h4>Rincian Produk</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->price, 2) }}</td>
                    <td>Rp{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>
        <strong>Total belanja (termasuk pajak): Rp{{ number_format($order->total_amount, 2) }} </strong>
    </p>

    {{-- Total --}}
    <div class="footer">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" width="75">
    </div>
</body>

</html>
