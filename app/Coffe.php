<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coffe extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class, 'coffe_id', 'id');
    }
}
