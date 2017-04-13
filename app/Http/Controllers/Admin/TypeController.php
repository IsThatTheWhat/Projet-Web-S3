<?php

namespace App\Http\Controllers\Admin;

use App\TypeProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TypeController extends Controller
{
    public function index(){
        $types = TypeProduct::paginate(10);
        return view('admin.type.index', compact('types'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:type_products|min:3|max:255',
        ]);

        TypeProduct::create($request->all());

        return redirect()->route('type.index')->with('success', 'Category successfully created');
    }

    public function destroy($id){
        $type = TypeProduct::find($id);
        $type->delete();
        return redirect()->route('type.index')->with('success', 'Category successfully destroyed');
    }
}
