<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('types')->paginate(6);
        return view('home', compact('products'));
    }

    public function show($id){
        $product = Product::with('comments')->find($id);
        return view('product.show', compact('product'));
    }

    public function addComment($id){
        if (!Auth::user()->allows()->where('id', $id)->first()){
            return redirect()->route('home');
        }
        $product = Product::find($id);
        return view('product.addComment', compact('product'));
    }

    public function setComment($id, Request $request){
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $attributes = [ 'content' => Purifier::clean($request->comment), 'user_id' => Auth::id(), 'product_id' => $id];
        Comment::create($attributes);

        Auth::user()->allows()->detach(Product::find($id));

        return redirect()->route('show', $id)->with('success', 'Comment successfully added');
    }

    public function destroyComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Comment successfully deleted');
    }
}
