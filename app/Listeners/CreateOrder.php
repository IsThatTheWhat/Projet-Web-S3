<?php

namespace App\Listeners;

use App\Events\NewOrder;
use App\Order;
use App\Product;
use App\State;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewOrder  $event
     * @return void
     */
    public function handle(NewOrder $event)
    {
        $order = Order::create([
            'user_id' => $event->user->id,
            'state_id' => 1,
        ]);

        $totalPrice = 0;

        foreach (session('cart') as $item) {
            $product = Product::find($item['id']);
            $order->products()->attach($product, ['quantity' => $item['quantity']]);
            $totalPrice += $item['quantity']*$product->price;
        }

        $order->update(['price' => $totalPrice]);
    }
}
