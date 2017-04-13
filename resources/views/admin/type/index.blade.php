@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="container">
        <div class="page-header text-center">
            <h1>List Of The Categories</h1>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->created_at }}</td>
                                <td>
                                    <form method="post" action="{{ route('type.destroy', $type->id) }}">
                                        <input type="hidden" id="_method" name="_method" value="DELETE"/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $types->links() }}
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <div class="well">
                    <div class="page-header text-center">
                        <h3>Create A Category</h3>
                    </div>
                    {!! BootForm::open()->action( route('type.store') ) !!}
                        {!! BootForm::text('Name', 'name')->placeholder('Name of the category') !!}
                        {!! BootForm::submit('Create', 'btn-success') !!}
                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
