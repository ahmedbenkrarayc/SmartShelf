<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Produit;

class OrderProduit extends Model
{
    protected $table = 'order_produit';
    protected $fillable = [
        'order_id',
        'produit_id',
        'quantity'
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function produit(){
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
