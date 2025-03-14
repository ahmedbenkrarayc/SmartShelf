<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Rayon;
use App\Models\OrderProduit;

class Produit extends Model
{
    protected $table = 'produit';
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'stock', 
        'category_id', 
        'rayon_id', 
        'is_promotion'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function rayon(){
        return $this->belongsTo(Rayon::class, 'rayon_id');
    }

    public function orderitems(){
        return $this->hasMany(OrderProduit::class, 'produit_id');
    }
}
