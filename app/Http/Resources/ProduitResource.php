<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;

class ProduitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'is_promotion' => $this->is_promotion,
            'category' => $this->whenLoaded('category', function(){
                return new CategoryResource($this->category);
            }),
            'rayon' => $this->whenLoaded('rayon', function(){
                return new RayonResource($this->rayon);
            })
        ];
    }
}
