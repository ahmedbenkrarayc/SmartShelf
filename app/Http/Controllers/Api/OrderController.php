<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduit;
use App\Http\Requests\MakeOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\UpdateStockJob;

class OrderController extends Controller
{

    public function makeOrder(MakeOrderRequest $request){
        $validated = $request->validated();

        DB::beginTransaction();

        try{
            $order = Order::create([
                'users_id' => $request->user_id,
                'total_price' => $request->total
            ]);

            foreach($request->products as $product){
                OrderProduit::create([
                    'order_id' => $order->id,
                    'produit_id' => $product['produit_id'],
                    'quantity' => $product['quantity']
                ]);

                UpdateStockJob::dispatch($product['produit_id'], $product['quantity']);
            }

            DB::commit();
            $order->load('items', 'user');
            return new OrderResource($order)->response()->setStatusCode(201);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['error' => 'Failed to place order', 'message' => $e->getMessage()], 500);
        }
    }

    public function orders(){
        $orders = Order::with('items', 'user')->get();
        return OrderResource::collection($orders);
    }

    public function getUserOrders(Request $request){
        $orders = Order::with('items', 'user')->where('users_id', $request->user()->id)->get();
        return OrderResource::collection($orders);
    }
}
