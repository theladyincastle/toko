<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    public $timestamps = true;
    protected $fillable = [
        'code_transaksi',
        'total_qty',
        'total_harga',
        'nama_customer',
        'alamat',
        'no_tlp',
        'ekspedisi',
        'status',
    ];

    public function details()
{
    return $this->hasMany(modelDetailTransaksi::class, 'id_transaksi', 'id');
}
public function detailTransaksi()
{
    return $this->hasMany(modelDetailTransaksi::class, 'id_transaksi', 'code_transaksi');
}


public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

    
    protected $hidden;
}
