<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $orders = Auth::user()->orders()->orderBy('state_id', 'asc')->get();
        $products = [];
        foreach ($orders as $order) {
            $products[$order->id] = $order->products()->get(['name', 'photo', 'quantity']);
        }
        return view('order.index', compact('orders', 'products', 'states'));
    }
}
