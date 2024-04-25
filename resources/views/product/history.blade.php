@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Riwayat Pesanan</div>

                <div class="card-body">
                    @if ($orders->isEmpty())
                        <p>Tidak ada pesanan yang ditemukan.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <!-- Tambahkan kolom lain jika diperlukan -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>Rp {{ $order->amount }}</td>
                                        <!-- Tambahkan kolom lain jika diperlukan -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
