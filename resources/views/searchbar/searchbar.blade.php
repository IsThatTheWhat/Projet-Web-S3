<div class="container">
    <div class="row searchbar">
        <div class="col-lg-10 col-md-offset-1">
            {!! BootForm::open()->action( route('search') ) !!}
            <div class="row">
                <div class="col-sm-6">
                    <input id="searchfield" type="text" class="form-control" placeholder="Looking for a particular product ?" name="search">
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select name="type" id="type" class="form-control">
                            @foreach($attributes as $k => $attribute)
                                <option value="{{ $k }}">{{ $attribute }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-block btn-success">Search</button>
                </div>
            </div>
            {!! BootForm::close() !!}
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
</div>