<?php

namespace App\Http\Controllers;

use App\Models\modelDetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Transaksi; 
use App\Models\Product;
use Carbon\Carbon;

class ReportController extends Controller
{
    
    public function showReport(Request $request)
    {
        
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');

        
        if ($dateStart) {
            $dateStart = Carbon::createFromFormat('Y-m-d', $dateStart)->startOfDay();
        }
        if ($dateEnd) {
            $dateEnd = Carbon::createFromFormat('Y-m-d', $dateEnd)->endOfDay();
        }


        $transaksi = ModelDetailTransaksi::with('product')
            ->when($dateStart, fn($query) => $query->where('transaction_date', '>=', $dateStart))
            ->when($dateEnd, fn($query) => $query->where('transaction_date', '<=', $dateEnd))
            ->get();

        return view('admin.page.report', compact('transaksi'));
    }

    
    public function transaksiReport()
    {
        $transaksi = Transaksi::with('detailTransaksi.product')->get();
        
        $title = 'Laporan Transaksi';
        return view('admin.page.transaksi_report', compact('transaksi', 'title'));
    }
    

    
    public function showProductReport(Request $request)
    {
    
        $productDateStart = $request->input('productDateStart');
        $productDateEnd = $request->input('productDateEnd');
        

        
        if ($productDateStart) {
            $productDateStart = Carbon::createFromFormat('Y-m-d', $productDateStart)->startOfDay();
        }
        if ($productDateEnd) {
            $productDateEnd = Carbon::createFromFormat('Y-m-d', $productDateEnd)->endOfDay();
        }

        
        $produk = Product::when($productDateStart, fn($query) => $query->where('created_at', '>=', $productDateStart))
            ->when($productDateEnd, fn($query) => $query->where('created_at', '<=', $productDateEnd))
            ->get();

        $title = 'Laporan Produk';

        return view('admin.page.product_report', compact('produk', 'title'));
    }
}
