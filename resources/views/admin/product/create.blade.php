@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
    <div class="container">
        <div class="page-header text-center">
            <h1>Create A Product</h1>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                {!! BootForm::open()->action( route('product.store') )->multipart() !!}
                    {!! BootForm::text('Name', 'name')->placeholder('Name') !!}
                    {!! BootForm::file('Photo', 'file') !!}
                    {!! BootForm::text('Price', 'price')->placeholder('Price') !!}
                    {!! BootForm::select('Available', 'available', ['default' => 'Please choose an option','0' => 'No', '1' => 'Yes']) !!}
                    {!! BootForm::text('Quantity In Stock', 'stock')->placeholder('Quantity') !!}
                    {!! BootForm::select('Category', 'type_id', $attributes) !!}
                    <a href="{{ route('product.index') }}" class="btn btn-default">Annuler</a>
                    {!! BootForm::submit('Submit', 'btn-primary') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection
