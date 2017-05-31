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
        $attributes = (new TypeProduct())->getAllTypesForInput();
        return view('home', compact('products', 'attributes'));
    }

    /**
     * Allows to see a product
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $product = Product::with('comments')->find($id);
        session()->forget('last_product');
        session(['last_product' => [
            'id' => $id,
            'photo' => $product->photo,
            'name' => $product->name,
            'category' => $product->types->name,
        ]]);
        return view('product.show', compact('product'));
    }

    public function clearLastProductFromSession(){
        session()->forget('last_product');
        //dd(session('last_product'));
        return redirect()->back();
    }

    /**
     * Makes the search
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        //Sdd($request->all());
        $attributes = (new TypeProduct())->getAllTypesForInput();
        if ($request->type == 'default'){
            $search = $request->search;
            $products = Product::where('name', 'like', "%$request->search%")->paginate(6);
            return view('home', compact('products', 'attributes', 'search'));
        }

        if (!$request->search){
            $search = TypeProduct::find($request->type)->name;
            $products = Product::whereHas('types', function ($query) use ($request){
               $query->where('id', $request->type);
            })->paginate(6);
            return view('home', compact('products', 'attributes', 'search'));
        }

        $search = [
            $request->search, TypeProduct::find($request->type)->name
        ];

        $products = Product::where('name', 'like', "%$request->search%")
            ->whereHas('types', function ($query) use ($request){
                $query->where('id', $request->type);
            })
            ->paginate(6);
        return view('home', compact('products', 'attributes', 'search'));

    }

    /**
     * Allows to comment on a product
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function addComment($id){
        if (!Auth::user()->allows()->where('id', $id)->first()){
            return redirect()->route('home');
        }
        $product = Product::find($id);
        return view('product.addComment', compact('product'));
    }

    /**
     * Sets a comment
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setComment($id, Request $request){
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $attributes = [ 'content' => Purifier::clean($request->comment), 'user_id' => Auth::id(), 'product_id' => $id];
        Comment::create($attributes);

        Auth::user()->allows()->detach(Product::find($id));

        return redirect()->route('show', $id)->with('success', 'Comment successfully added');
    }

    /**
     * Destroys a comment
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Comment successfully deleted');
    }
}
