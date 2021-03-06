@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <!-- Search Bar -->
    @include('searchbar.searchbar')
    <!-- /Search Bar -->

    <div class="container">
        @if(!isset($search))
            <h3> {{ $products->total() }} product(s) in total</h3>
            <h4> {{ $products->count() }} product(s) in this page</h4>
        @else
            <div id="search_recap" class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3>
                        {{ $products->total() }} product(s) for
                        @if(sizeof($search) != 2)
                            <span class="label label-primary">{{ $search }}</span>
                        @else
                            @foreach($search as $name)
                                <span class="label label-primary">{{ $name }}</span>
                            @endforeach
                        @endif
                    </h3>
                </div>
            </div>
        @endif
        <div class="row">
            @forelse($products as $product)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="{{ action('HomeController@show', $product->id) }}"><img class="img" src="{{ asset('img/'.$product->photo) }}" alt="Foto of {{ $product->name }}"></a>
                        <div class="caption">
                            <h3>{{ $product->name }}</h3>
                            <h3>Price : {{ $product->price }} $</h3>
                            <h3>Category : {{ $product->types->name }}</h3>
                            <h3>Quantity : {{ $product->stock }} products</h3>
                            <a href="{{ action('HomeController@show', $product->id) }}" class="btn btn-primary product__view_btn">View</a>
                            <div class="row">
                                <div class="col-sm-6">
                                    @if($product->available == 1)
                                        <a href="{{ action('CartController@add', $product->id) }}" class="btn btn-success">Add To Cart</a>
                                    @else
                                        <button class="btn btn-danger">Not Available Now</button>
                                    @endif

                                </div>
                                <div class="col-sm-6">
                                    @if(Auth::user() && Auth::user()->allows()->where('id', $product->id)->first())
                                        <a href="{{ action('HomeController@addComment', $product->id) }}" class="btn btn-info">Leave A Comment</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3>Sorry no products available!</h3>
            @endforelse
        </div>
        {{ $products->links() }}
    </div>
@endsection