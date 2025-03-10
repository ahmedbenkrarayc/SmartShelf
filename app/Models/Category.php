<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'name', 
        'description'
    ];

    public function produits(){
        return $this->hasMany(Produit::class, 'category_id');
    }
}
