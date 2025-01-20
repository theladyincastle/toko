<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use App\Models\product;
use App\Models\tblCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $best = product::where('quantity','>=',5)->get();
        $data = product::paginate(15);
        $countKeranjang = tblCart::where(['idUser' => 'guest123', 'status' => 0])->count();
        return view('pelanggan.page.home', [
            'title'     => 'Home',
            'data'      => $data,
            'best'      => $best,
            'count'     => $countKeranjang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addTocart(Request $request)
    {
        $request->validate([
            'idProduct' => 'required|exists:products,id',
        ]);
    
        $idProduct = $request->input('idProduct');
        $product = product::find($idProduct);
    
        if (!$product) {
            Alert::error('Error', 'Produk tidak ditemukan!');
            return redirect('/');
        }
    
        tblCart::create([
            'idUser'    => 'guest123',
            'id_barang' => $idProduct,
            'qty'       => 1,
            'price'     => $product->harga,
        ]);
    
        Alert::success('Berhasil', 'Produk berhasil ditambahkan ke keranjang!');
        return redirect('/');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cartItems = tblCart::where(['idUser' => 'guest123', 'status' => 0])->get();
    
        if ($cartItems->isEmpty()) {
            Alert::error('Error', 'Keranjang belanja kosong!');
            return redirect('/');
        }
    
        $totalQty = $cartItems->sum('qty');
        $totalHarga = $cartItems->sum(function ($item) {
            return $item->qty * $item->price;
        });
    
        $transaksi = transaksi::create([
            'code_transaksi' => 'TRX-' . now()->timestamp,
            'total_qty'      => $totalQty,
            'total_harga'    => $totalHarga,
            'nama_customer'  => 'Guest Customer',
            'alamat'         => 'Unknown',
            'no_tlp'         => '0000000000',
            'ekspedisi'      => 'Standard',
            'status'         => 'pending',
        ]);
    
        foreach ($cartItems as $item) {
            $transaksi->details()->create([
                'id_barang' => $item->id_barang,
                'qty'       => $item->qty,
                'price'     => $item->price,
            ]);
        }
    
        tblCart::where(['idUser' => 'guest123', 'status' => 0])->update(['status' => 1]);
    
        Alert::success('Berhasil', 'Transaksi berhasil disimpan!');
        return redirect('/transaksi');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(transaksi $transaksi)
    {
        $details = $transaksi->details;
        return view('pelanggan.page.transaksi_detail', [
            'title'    => 'Detail Transaksi',
            'transaksi' => $transaksi,
            'details'   => $details,
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetransaksiRequest $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi $transaksi)
    {
        $transaksi->details()->delete();
        $transaksi->delete();
    
        Alert::success('Berhasil', 'Transaksi berhasil dihapus!');
        return redirect('/transaksi');
    }
    
}