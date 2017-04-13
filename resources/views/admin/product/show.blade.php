@extends('layouts.admin')

@section('title', $product->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <img src="{{ asset("img/$product->photo") }}" alt="photo of {{ $product->name }}" class="img-responsive img-rounded" height="300" width="800">

                <h1>{{ $product->name }}</h1>

                <div class="well">
                    <h3><strong>Category :</strong> {{ $product->types->name }}</h3>
                    <h3><strong>Price :</strong> {{ $product->price }} €</h3>
                    <h3><strong>Available :</strong> {{ $product->available }}</h3>
                    <h3><strong>Stock :</strong> {{ $product->stock }}</h3>
                    <h3><strong>Created At :</strong> {{ $product->created_at }}</h3>
                    <h3><strong>Updated At :</strong> {{ $product->updated_at }}</h3>
                </div>
            </div>
        </div>

        <div class="row admin__show_control_btn">
            <div class="col-sm-3 col-md-offset-4">
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
            </div>
            <div class="col-sm-3">
                <form method="post" action="{{ route('product.destroy', $product->id) }}">
                    <input type="hidden" id="_method" name="_method" value="DELETE"/>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
