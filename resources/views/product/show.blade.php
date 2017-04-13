@extends('layouts.app')

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
                </div>

                <div class="page-header text-left">
                    <h1>Comments</h1>
                </div>
                @forelse($product->comments as $comment)
                    <div class="panel panel-default">
                        <div class="panel-heading comment__title text-left">
                            <div class="media">
                                <div class="media-left">
                                    <a href="{{ route('profile', $comment->users->id) }}">
                                        <img class="media-object img-rounded" src="{{ asset("img/".$comment->users->picture) }}" alt="photo of {{ $comment->users->name }}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h3 class="panel-title pull-left">{{ $comment->users->name }} <small>{{ $comment->created_at }}</small></h3>
                                    @if($comment->users->id == Auth::id())
                                        <form method="post" action="{{ route('comment.destroy', $comment->id ) }}">
                                            <input type="hidden" id="_method" name="_method" value="DELETE"/>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="close"><span aria-hidden="true">X</span></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            {{--<h3 class="panel-title pull-left">{{ $comment->users->name }} <small>{{ $comment->created_at }}</small></h3>
                            @if($comment->users->id == Auth::id())
                                <form method="post" action="{{ route('comment.destroy', $comment->id ) }}">
                                    <input type="hidden" id="_method" name="_method" value="DELETE"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="close"><span aria-hidden="true">X</span></button>
                                </form>
                            @endif--}}
                        </div>
                        <div class="panel-body text-left">
                            {!! $comment->content !!}
                        </div>
                    </div>
                @empty
                    <h3>No Comments Yet On This Product !</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection