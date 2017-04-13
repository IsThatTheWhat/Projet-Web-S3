@extends('layouts.app')

@section('title', 'Edit My Profile')

@section('scripts')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
@endsection

@section('content')
    <div class="container">
        <div class="page-header text-center">
            <h1>Change Your Info</h1>
        </div>
        <div class="row profile__update">
            <div class="col-sm-8 col-sm-offset-2">
                {!! BootForm::open()->action( route('profile.update') )->put()->multipart() !!}
                    {!! BootForm::bind($user) !!}
                    {!! BootForm::file('Profile Picture :', 'file') !!}
                    {!! BootForm::text('First Name :', 'name') !!}
                    {!! BootForm::text('Last Name :', 'lastName') !!}
                    {!! BootForm::password('Old Password :', 'oldPassword') !!}
                    {!! BootForm::password('New Password :', 'newPassword') !!}
                    {!! BootForm::text('Email :', 'email') !!}
                    {!! BootForm::text('Billable Address :', 'address') !!}
                    {!! BootForm::textarea('About Me :', 'about') !!}
                    <a href="{{ route('profile', Auth::id()) }}" class="btn btn-default">Annuler</a>
                    {!! BootForm::submit('Submit', 'btn-primary') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection