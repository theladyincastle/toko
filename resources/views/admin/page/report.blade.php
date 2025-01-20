@extends('admin.layout.index')

@section('content')
<title>@yield('title', 'Report Page')</title>

<div class="d-flex flex-row justify-content-start gap-2 align-items-start">
    
    <div class="card">
        <div class="card-header">
            <h4 style="font-size: 16px;">Export data transaksi</h4>
        </div>
        <div class="card-body">
            <div class="d-flex flex-row gap-3">
                <div class="d-flex flex-column">
                    <label for="dateStart">Tanggal Mulai</label>
                    <input type="date" name="dateStart" class="form-control" id="dateStart">
                </div>
                <div class="d-flex flex-column">
                    <label for="dateEnd">Tanggal Akhir</label>
                    <input type="date" name="dateEnd" class="form-control" id="dateEnd">
                </div>
            </div>
            <button class="btn btn-success mt-4" id="exportBtn">Export</button>
            <a href="{{ route('report.transaksi_report') }}" class="btn btn-primary mt-4">Lihat Laporan Transaksi</a>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header">
            <h4 style="font-size: 16px;">Export data produk</h4>
        </div>
        <div class="card-body">
            <div class="d-flex flex-row gap-3">
                <div class="d-flex flex-column">
                    <label for="productDateStart">Tanggal Mulai</label>
                    <input type="date" name="productDateStart" class="form-control" id="productDateStart">
                </div>
                <div class="d-flex flex-column">
                    <label for="productDateEnd">Tanggal Akhir</label>
                    <input type="date" name="productDateEnd" class="form-control" id="productDateEnd">
                </div>
            </div>
            <button class="btn btn-success mt-4" id="exportProductBtn">Export</button>
            <a href="{{ route('report.product_report') }}" class="btn btn-primary mt-4">Lihat Laporan Produk</a>
        </div>
    </div>
</div>



</div>

@endsection
