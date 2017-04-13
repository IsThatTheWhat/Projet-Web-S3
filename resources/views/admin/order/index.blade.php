@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <div class="container">
        <div class="page-header text-center">
            <h1>List Of Orders</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>User Address</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Update At</th>
                    <th>State</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->users->name }}</td>
                        <td>{{ $order->users->address }}</td>
                        <td>{{ $order->price }} €</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->updated_at }}</td>
                        <td>
                            @if($order->state_id == 1)
                                <button class="btn btn-default">{{ $order->states->name }}</button>
                            @else
                                <button class="btn btn-success">{{ $order->states->name }}</button>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-primary">View Order</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </div>
@endsection