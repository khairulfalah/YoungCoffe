<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{

    protected $fillable = [
        'jumlah_pesanan',
        'total_harga',
        'bucket',
        'nama',
        'quotes',
        'product_id',
        'pesanan_id'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'pesanan_id', 'id');
    }

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
