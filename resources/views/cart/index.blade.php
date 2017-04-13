@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container">
        <div class="cart-links">
            <a href="{{ route('home') }}">Continue Shopping</a>
            <a href="{{ action('CartController@clear') }}">Clear Cart</a>
        </div>
        <div class="cart-products">
            @foreach($products as $key => $product)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Product : </strong>{{ $product['product']->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <img class="img-responsive" src="img/{{ $product['product']->photo }}" alt="{{ $product['product']->photo }}">
                            </div>
                            <div class="col-sm-3">
                                <h4><strong>Quantity</strong></h4>
                                <a href="{{ action('CartController@minus', $product['product']->id) }}" class="btn btn-primary">-</a>
                                <strong>{{ $product['quantity'] }}</strong>
                                <a href="{{ action('CartController@plus', $product['product']->id) }}" class="btn btn-primary">+</a>
                            </div>
                            <div class="col-sm-3">
                                <h4><strong>Price</strong></h4>
                                <h4>{{ $product['product']->price }} € per unite</h4>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ action('CartController@remove', $key) }}">Remove from cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if(sizeof($products) != 0)
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <h1>Total : {{ $total }} €</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 col-sm-offset-5">
                    <a href="{{ route('cart.purchase') }}" class="btn btn-success btn-lg">Purchase</a>
                </div>
            </div>
        @else
            <h2>Your cart is empty !</h2>
        @endif
    </div>
@endsection