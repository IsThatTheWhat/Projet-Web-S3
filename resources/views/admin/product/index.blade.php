@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="container">
        <div class="page-header text-center">
            <h1>List Of The Products</h1>
        </div>
        <div class="row admin__add_product">
            <div class="col-sm-2 col-sm-offset-5">
                <a href="{{ route('product.create') }}" class="btn btn-block btn-success">Add A Product</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Available</th>
                    <th>Quantity In Stock</th>
                    <th>Created At</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->types->name }}</td>
                        <td>{{ $product->price }} €</td>
                        <td>
                            @if($product->available == 1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td><a href="{{ route('product.show', $product->id) }}" class="btn btn-info">View</a></td>
                        <td><a href="{{ route('product.edit', $product->id) }}" class="btn btn-info">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
@endsection
