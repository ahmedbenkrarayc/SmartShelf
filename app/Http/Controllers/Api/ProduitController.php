<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Http\Resources\ProduitResource;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index(){
        $produits = Produit::with('category', 'rayon')->get();
        return ProduitResource::collection($produits);
    }

    public function store(StoreProduitRequest $request){
        $validated = $request->validated();

        $product = Produit::create($validated);
        return (new ProduitResource($product))->response()->setStatusCode(201);
    }

    public function show(string $slug){
        $product = Produit::with('category', 'rayon')->whereRaw('LOWER(name) = ?', [Str::replace('-', ' ', strtolower($slug))])->first();
        if(!$product){
            return response()->json([
                'message' => 'Product not found !'
            ], 404);
        }

        return new ProduitResource($product);
    }

    public function update(UpdateProduitRequest $request, int $id){
        $validated = $request->validated();

        $product = Produit::find($id);
        if(!$product){
            return response()->json([
                'message' => 'Product not found !'
            ], 404);
        }

        $product->update($validated);
        return new ProduitResource($product);
    }

    public function destroy(int $id){
        $product = Produit::find($id);
        if(!$product){
            return response()->json([
                'message' => 'Product not found !'
            ], 404);
        }

        $product->delete();
        return response()->json([], 204);
    }

    public function productByRayon(string $rayon){
        $produits = Produit::with('category', 'rayon')->whereHas('rayon', function($query) use ($rayon){
            $query->where('name', $rayon);
        })->get();

        return ProduitResource::collection($produits);
    }

    public function productByKeyword(string $keyword){
        $produits = Produit::with('category', 'rayon')->where('name', 'like', "%${keyword}%")->orWhereHas('category', function($query) use ($keyword){
            $query->where('name', $keyword);
        })->get();

        return ProduitResource::collection($produits);
    }

    public function promotions(){
        $produits = Produit::with('category', 'rayon')->where('is_promotion', 1)->get();
        return ProduitResource::collection($produits);
    }

    public function top10(){
        $produits = Produit::with('category', 'rayon')
        ->WhereHas('orderitems')
        ->withCount('orderitems') 
        ->orderByDesc('orderitems_count')  
        ->limit(10)
        ->get();

        return ProduitResource::collection($produits);
    }

    public function stockCritique(){
        $produits = Produit::where('stock', '<=', 5)->get();
        return ProduitResource::collection($produits);
    }
}
