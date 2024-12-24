<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
            'kode_pemesanan',
            'status',
            'total_harga',
            'kode_unik',
            'user_id'
    ];

    
    public function detail_orders()
    {
        return $this->hasMany(DetailOrder::class, 'pesanan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
