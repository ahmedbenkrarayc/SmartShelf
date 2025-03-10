<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProduit;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'users_id', 
        'total_price'
    ];

    public function items(){
        return $this->hasMany(OrderProduit::class, 'order_id');
    }
}
