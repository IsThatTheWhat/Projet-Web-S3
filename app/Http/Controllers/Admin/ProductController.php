<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductAddFormRequest;
use App\Product;
use App\TypeProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = $this->getTypesForFormSelect();
        return view('admin.product.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductAddFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductAddFormRequest $request)
    {
        if ($request->file){
            $filename = $this->addPhoto($request->file);

            $attributes = array_merge($request->except('file'), ['photo' => $filename]);
            Product::create($attributes);
        } else {
            Product::create($request->all());
        }

        return redirect()->route('product.index')->with('success', 'Product successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $attributes = $this->getTypesForFormSelect();
        return view('admin.product.edit', compact('product', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductAddFormRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductAddFormRequest $request, $id)
    {
        $product = Product::find($id);

        if ($request->file){
            $oldFile = $product->photo;
            $newFile = $this->addPhoto($request->file);

            $attributes = array_merge($request->except('file'), ['photo' => $newFile]);
            $product->update($attributes);
            if ($oldFile !== 'uyuni.jpg'){
                Storage::delete($oldFile);
            }

        } else {
            $product->update($request->all());
        }
        return redirect()->route('product.show', $id)->with('success', 'Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (($oldFile = $product->photo) !== 'uyuni.jpg'){
            Storage::delete($oldFile);
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product successfully destroyed');
    }

    /**
     * Get all the products types plus the default value for the form select
     *
     * @return mixed
     */
    private function getTypesForFormSelect(){
        $types = TypeProduct::all();
        $attributes['default'] = 'Please choose a category';
        foreach ($types as $type) {
            $attributes[$type->id] = $type->name;
        }
        return $attributes;
    }



    /**
     * Adds a photo into the img directory and returns the file name
     *
     * @param $file
     * @return string $filename
     */
    private function addPhoto($file){
        $image = $file;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('img/'.$filename);
        Image::make($image)->resize(800, 300)->save($location);

        return $filename;
    }
}
