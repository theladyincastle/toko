@extends('admin.layout.index')

@section('content')
<title>@yield('title', 'Product Report')</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <h3 class="mb-4 text-dark" style="font-family: 'Poppins', sans-serif;">{{ $title }}</h3>
    <div class="table-container" style="background-color: #f5f5dc; border-radius: 10px; padding: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
        <table class="table table-bordered table-hover text-center" style="background-color: #fff;">
            <thead style="background-color: #d2b48c; color: #000;">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $index => $product)
                    <tr style="background-color: #fff; color: #4a4a4a;">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->nama_product }}</td> 
                        <td>{{ $product->kategory }}</td> 
                        <td>Rp{{ number_format($product->harga, 0, ',', '.') }}</td>  
                        <td>{{ $product->quantity }}</td>  
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data produk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
