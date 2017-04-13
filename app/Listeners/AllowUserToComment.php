<?php

namespace App\Listeners;

use App\Allow;
use App\Events\NewOrder;
use App\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

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
            $allow = Allow::where([
                ['user_id', '=', Auth::id()],
                ['product_id', '=', $item['id']]
            ])->first();
            if ($allow){
                $product = Product::find($item['id']);
                $event->user->allows()->attach($product);
            }
        }
    }
}
