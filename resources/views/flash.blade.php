@if(session('error'))
    <div class="container">
        <div class="alert alert-danger">
            {!! session('error') !!}
        </div>
    </div>
@elseif(session('success'))
    <div class="container">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@elseif(session('status'))
    <div class="container">
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    </div>
@endif