@extends('layouts.admin')

@section('title', 'Order')

@section('content')
    <div class="container">
        <div class="cart-products">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order Reference : </strong>{{ $order->id }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row text-center">
                        <div class="col-sm-3">
                            <h4><strong>User :</strong> {{ $order->users->name }}</h4>
                        </div>
                        <div class="col-sm-3">
                            <h4><strong>Address :</strong> {{ $order->users->address }}</h4>
                        </div>
                        <div class="col-sm-3">
                            <h4><strong>Date :</strong> {{ $order->created_at }}</h4>
                        </div>
                        <div class="col-sm-3">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            @foreach($products as $product)
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
                    <div class="row order__btn_change_state">
                        <div class="col-sm-4 col-sm-offset-4">
                            @if($order->state_id == 1)
                                <form method="post" action="{{ route('order.state', $order->id) }}">
                                    <input type="hidden" id="_method" name="_method" value="PUT"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-block btn-primary">Change State</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection