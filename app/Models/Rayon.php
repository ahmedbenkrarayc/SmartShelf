<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class Rayon extends Model
{
    protected $table = 'rayon';
    protected $fillable = [
        'name', 
        'description'
    ];

    public function produits(){
        return $this->hasMany(Produit::class, 'rayon_id');
    }
}
