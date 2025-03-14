<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderProduit;
use App\Models\User;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'users_id', 
        'total_price'
    ];
    protected $with = ['items.produit', 'user'];

    public function items(){
        return $this->hasMany(OrderProduit::class, 'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class ,'users_id');
    }
}
