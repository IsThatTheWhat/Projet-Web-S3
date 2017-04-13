@extends('layouts.app')

@section('title', $product->name)

@section('scripts')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <img src="{{ asset("img/$product->photo") }}" alt="photo of {{ $product->name }}" class="img-responsive img-rounded" height="300" width="800">

                <h1>{{ $product->name }}</h1>

                <div class="well">
                    <h3><strong>Category :</strong> {{ $product->types->name }}</h3>
                    <h3><strong>Price :</strong> {{ $product->price }} €</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8 col-md-offset-2">
                {!! BootForm::open()->action( action('HomeController@setComment', $product->id) ) !!}
                    {!! BootForm::textarea('Leave Your Comment Here :', 'comment') !!}
                    {!! BootForm::submit('Submit', 'btn-primary') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection