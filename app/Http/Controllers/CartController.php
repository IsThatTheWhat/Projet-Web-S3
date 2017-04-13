<?php

namespace App\Http\Controllers;

use App\Allow;
use App\Events\NewOrder;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * shows all the items in the cart
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $total = 0;
        $products = $this->findProductFromCart();
        foreach ($products as $product) {
            $total += $product['product']->price * $product['quantity'];
        }
        return view('cart.index', compact('products', 'total'));
    }


    /**
     * adds a product to the cart
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($id){
        $change = false;
        if (sizeof(session('cart')) != 0 ){
            foreach (session('cart') as $key => $item) {
                if ($item['id'] == $id){
                    $change = true;
                    $k = $key;
                }
            }

            if (!$change){
                session()->push('cart', [
                    'id' => $id,
                    'quantity' => 1,
                ]);
            } else {
                $value = session("cart.$k.quantity");
                session(["cart.$k.quantity" => $value + 1]);
            }
        } else {
            session()->push('cart', [
                'id' => $id,
                'quantity' => 1,
            ]);
        }
        return redirect()->route('cart.index');
    }

    /**
     * clears the cart
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear(){
        session()->forget('cart');
        return redirect()->route('cart.index');
    }

    /**
     * removes a product from the cart
     *
     * @param $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($key){
        session()->forget("cart.$key");
        $this->updateSessionCart();
        return redirect()->back();
    }

    /**
     * increases the quantity of a product in the cart
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function plus($id){
        $key = $this->findSessionKeyFromId($id);
        $value = session("cart.$key.quantity");
        session(["cart.$key.quantity" => $value + 1]);
        return redirect()->back();
    }

    /**
     * decreases a product's quantity in the cart
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function minus($id){
        $key = $this->findSessionKeyFromId($id);
        $value = session("cart.$key.quantity");
        if ($value == 1){
            return $this->remove($key);
        } else {
            session(["cart.$key.quantity" => $value - 1]);
            return redirect()->back();
        }
    }

    /**
     * purchase the products in the cart
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purchase(){
        $res = $this->testQuantity();
        if ($res){
            return redirect()
                ->back()
                ->with('error', 'The quantity asked for the product : <strong>' . $res . '</strong> is higher than the quantity available !');
        }

        if (!Auth::user()->address){
            return redirect()
                ->back()
                ->with('error', 'Make sure to set your address! You can do it by updating your profile.');
        }

        event(new NewOrder(Auth::user()));

        $this->updateStock();

        session()->forget('cart');

        return redirect()->route('order.index');
    }

    /**
     * finds a key from an id in the session
     *
     * @param $id
     * @return int|string
     */
    private function findSessionKeyFromId($id){
        if (sizeof(session('cart')) != 0){
            foreach (session('cart') as $key => $item) {
                if ($item['id'] == $id){
                    return $key;
                }
            }
        }
    }

    /**
     * finds the products in the cart
     *
     * @return array
     */
    private function findProductFromCart(){
        $products = [];
        if (sizeof(session('cart')) != 0){
            foreach (session('cart') as $item){
                $products[] = ['product' => Product::find($item['id']), 'quantity' => $item['quantity']];
            }
        }
        return $products;
    }

    /**
     * updates the session
     */
    private function updateSessionCart(){
        $products = session('cart');
        session()->forget('cart');
        foreach ($products as $product) {
            session()->push('cart', $product);
        }
    }

    /**
     * tests if the quantity asked is less than the product's quantity
     *
     * @return null
     */
    private function testQuantity(){
        foreach (session('cart') as $item) {
            $product = Product::where('id', $item['id'])->select(['name', 'stock'])->first();
            $quantity = $product->stock;
            if ($item['quantity'] > $quantity) { return $product->name; }
        }
        return null;
    }

    /**
     * updates the product's stock and disables it if the stock = 0
     */
    private function updateStock(){
        foreach (session('cart') as $item) {
            $product = Product::find($item['id']);
            $quantity = $product->stock;
            $quantity = $quantity - $item['quantity'];

            if ($quantity == 0) {
                $product->update([
                    'stock' => $quantity,
                    'available' => 0
                ]);
            } else {
                $product->update(['stock' => $quantity]);
            }
        }
    }
}
