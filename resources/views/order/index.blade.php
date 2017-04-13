@extends('layouts.app')

@section('title', 'Order')

@section('content')
    <div class="container">
        <div class="cart-links">
            <a href="{{ route('home') }}">Continue Shopping</a>
        </div>
        <div class="cart-products">
            @forelse($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Order Reference : </strong>{{ $order->id }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                @foreach($products[$order->id] as $product)
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4><strong>Product :</strong> {{ $product->name }}</h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4><strong>Quantity : </strong>{{ $product->quantity }}</h4>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 state">
                                        <h1><strong>Status</strong></h1>
                                        @if($order->state_id == 1)
                                            <button class="btn btn-info">En Cours de préparation</button>
                                        @else
                                            <button class="btn btn-success">Expédié</button>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <h1><strong>Total Price</strong></h1>
                                        <h2>{{ $order->price }} €</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2>You have no orders currently !</h2>
            @endforelse
        </div>
    </div>
@endsection