<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function show(int $id){
        $product = Produit::find($id);
        if(!$product){
            return response()->json([
                'message' => 'Product not found !'
            ], 404);
        }

        return new ProduitResource($product);
    }

    public function update(UpdateProduitRequest $request){
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
}
