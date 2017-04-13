@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="profile">
                    <div class="jumbotron">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{ asset("img/$user->picture") }}" alt="photo of {{ $user->picture }}" class="img-responsive img-rounded" height="200" width="200">
                                <h1>{{ $user->name }}</h1>
                            </div>
                            <div class="col-sm-8">
                                <h2>About Me!</h2>
                                {!! $user->about !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 text-right">
                        <h3><span class="label label-default">Email</span></h3>
                        <h3><span class="label label-default">First Name</span></h3>
                        <h3><span class="label label-default">Last Name</span></h3>
                        <h3><span class="label label-default">Address</span></h3>
                    </div>
                    <div class="col-sm-6 text-left">
                        <h3>
                            @if($user->email)
                                {{ $user->email }}
                            @else
                                No info given yet!
                            @endif
                        </h3>
                        <h3>
                            @if($user->name)
                                {{ $user->name }}
                            @else
                                No info given yet!
                            @endif
                        </h3>
                        <h3>
                            @if($user->lastName)
                                {{ $user->lastName }}
                            @else
                                No info given yet!
                            @endif
                        </h3>
                        <h3>
                            @if($user->address)
                                {{ $user->address }}
                            @else
                                No info given yet!
                            @endif
                        </h3>
                    </div>
                </div>

                @if($user->id == Auth::id())
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary profile_btn">Change Your Info</a>
                @endif

            </div>
        </div>
    </div>
@endsection