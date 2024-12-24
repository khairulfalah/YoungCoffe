<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function coffe()
    {
        return $this->belongsTo(Coffe::class, 'coffe_id', 'id');
    }

    public function detail_orders()
    {
        return $this->hasMany(DetailOrder::class, 'product_id', 'id');
    }
}
