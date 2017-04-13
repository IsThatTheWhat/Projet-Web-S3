@extends('layouts.admin')

@section('title', 'Update Product')

@section('content')
    <div class="container">
        <div class="page-header text-center">
            <h1>Create A Product</h1>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                {!! BootForm::open()->action( route('product.update', $product->id) )->put()->multipart() !!}
                    {!! BootForm::text('Name', 'name')->value($product->name) !!}
                    {!! BootForm::file('Photo', 'file') !!}
                    {!! BootForm::text('Price', 'price')->value($product->price) !!}
                    {!! BootForm::select('Available', 'available', ['default' => 'Please choose an option','0' => 'No', '1' => 'Yes'])->select($product->available) !!}
                    {!! BootForm::text('Quantity In Stock', 'stock')->placeholder('Quantity')->value($product->stock) !!}
                    {!! BootForm::select('Category', 'type_id', $attributes)->select($product->type_id) !!}
                    <a href="{{ route('product.index') }}" class="btn btn-default">Annuler</a>
                    {!! BootForm::submit('Submit', 'btn-primary') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection
