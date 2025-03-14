<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'date' => $this->created_at,
            'user' => $this->whenLoaded('user', function(){
                return [
                    'fname' => $this->user->fname,
                    'lname' => $this->user->lname,
                    'email' => $this->user->email
                ];
            }),
            'items' => $this->whenLoaded('items', function(){
                return $this->items->map(function($item){
                    return [
                        'product' => [
                            'id' => $item->produit->id,
                            'name' => $item->produit->name,
                            'price' => $item->produit->price
                        ],
                        'quantity' => $item->quantity
                    ];
                });
            })
        ];
    }
}
