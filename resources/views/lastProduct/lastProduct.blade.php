@if(session('last_product'))
    <div id="compareBar" class="compareBar">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <a href="{{ route('clearLP') }}" id="btn_close" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>

                <div class="media">
                    <div class="media-left">
                        <a href="{{ route('show', session('last_product.id')) }}">
                            <img id="media_photo" class="media-object" src="{{ asset("img/" . session('last_product.photo')) }}" alt="{{ session('last_product.photo') }}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ session('last_product.name') }}</h4>
                        <p>{{ session('last_product.category') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

