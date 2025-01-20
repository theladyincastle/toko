@extends('admin.layout.index')

@section('content')
<title>@yield('title', 'Report Page')</title>

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
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Nama Barang</th>  
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $index => $transaksi)
                    <tr style="background-color: #fff; color: #4a4a4a;">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transaksi->id }}</td>
                        <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                        <td>Rp{{ number_format($transaksi->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge 
                                @if($transaksi->status == 'pending') bg-warning text-dark 
                                @elseif($transaksi->status == 'completed') bg-success 
                                @else bg-danger @endif">
                                {{ ucfirst($transaksi->status) }}
                            </span>
                        </td>
                        
                        <td>
                            @foreach($transaksi->detailTransaksi as $detail)
                            @if($detail->product)
                                <div>{{ $detail->product->nama_product }}</div>
                            @else
                                <div>Product Not Found</div>
                            @endif
                        @endforeach
                        
                        
                        </td>
                        
                        
                        
                        
                        
                        <td>
                            <ul class="list-unstyled text-start">
                                @foreach($transaksi->detailTransaksi as $detail)
                                    <li>
                                        <strong>{{ $detail->product->harga }}</strong><br>
                                        Qty: {{ $detail->qty }} <br>
                                        Harga: Rp{{ number_format($detail->price, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada data transaksi</td>  
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
