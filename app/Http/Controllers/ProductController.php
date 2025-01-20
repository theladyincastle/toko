<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.product', [
            'name'      => "Product",
            'title'     => 'Admin Product',
        ]);
    }

    /**
     * Return data for DataTables.
     */
    public function getProductsData()
    {
        $products = Product::select([
            'id', 'sku', 'nama_product', 'type', 'kategory', 'harga', 'discount', 'quantity', 'quantity_out', 'is_active', 'foto','created_at'
        ]);
    
        return DataTables::of($products)
            ->addColumn('foto', function ($row) {
                return '<img src="' . asset('storage/product/' . $row->foto) . '" alt="' . $row->nama_product . '" style="width: 50px; height: 50px;">';
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin.products.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <a href="' . route('admin.products.delete', $row->id) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus produk ini?\')">Hapus</a>';
            })
            ->editColumn('is_active', function ($row) {
                return $row->is_active ? 'Aktif' : 'Nonaktif';
            })
            ->rawColumns(['foto', 'action'])
            ->make(true);
    }
    
    /**
     */
    public function addModal()
    {
        return view('admin.modal.addModal', [
            'title' => 'Tambah Data Product',
            'sku'   => 'BRG' . rand(10000, 99999),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductRequest $request)
    {
        $data = new Product;
        $data->sku          = $request->sku;
        $data->nama_product = $request->nama;
        $data->type         = $request->type;
        $data->kategory     = $request->kategori;
        $data->harga        = $request->harga;
        $data->quantity     = $request->quantity;
        $data->discount     = 10 / 100;
        $data->is_active    = 1;

        if ($request->hasFile('foto')) {
            $photo = $request->file('foto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/product'), $filename);
            $data->foto = $filename;
        }
        $data->save();
        Alert::toast('Data berhasil disimpan', 'success');
        return redirect()->route('product');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Product::findOrFail($id);

        return view(
            'admin.modal.editModal',
            [
                'title' => 'Edit data product',
                'data'  => $data,
            ]
        )->render();
    }
    
    public function update(UpdateproductRequest $request, Product $product, $id)
    {
        $data = Product::findOrFail($id);

        if ($request->file('foto')) {
            $photo = $request->file('foto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/product'), $filename);
            $data->foto = $filename;
        } else {
            $filename = $request->foto;
        }

        $field = [
            'sku'                   => $request->sku,
            'nama_product'          => $request->nama,
            'type'                  => $request->type,
            'kategory'              => $request->kategori,
            'harga'                 => $request->harga,
            'quantity'              => $request->quantity,
            'discount'              => 10 / 100,
            'is_active'             => 1,
            'foto'                  => $filename,
        ];

        $data::where('id',$id)->update($field);
        Alert::toast('Data berhasil diupdate', 'success');
        return redirect()->route('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        $json = [
            'success' => "Data berhasil dihapus"
        ];

        echo json_encode($json);
    }
}
