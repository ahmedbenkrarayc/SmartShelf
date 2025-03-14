<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Produit;
use App\Events\ProductStockLow;

class UpdateStockJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $product_id,
        public int $quantity
    )
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product = Produit::find($this->product_id);
        $product->decrement('stock', $this->quantity);
        if ($product->stock <= 5) {
            ProductStockLow::dispatch($product);
        }
    }
}
