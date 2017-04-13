<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('users')->orderBy('state_id', 'asc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function changeState($id){
        $order = Order::find($id);
        $order->update(['state_id' => 2]);
        return redirect()->back()->with('success', 'State successfully changed');
    }
}
