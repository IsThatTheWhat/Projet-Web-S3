<?php

namespace App\Listeners;

use App\Events\NewOrder;
use App\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AllowUserToComment
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
        foreach (session('cart') as $item) {
            $product = Product::find($item['id']);
            $event->user->allows()->attach($product);
        }
    }
}
