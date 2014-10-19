@extend('_frontend.master')
@section('breadcrumb')
{{ HTML::decode(Breadcrumbs::render('galeriak.show',$gallery)) }}
@stop
@section('content')
<div class="gallery">
    <h1>{{$gallery->name}}</h1>
    @if($gallery->description)
    <h4>Leírás</h4>
    <p>{{$gallery->description}}</p>
    @endif

    <div class="gallery-pictures">
        <ul class="row list-unstyled">
            @foreach($gallery->pictures as $picture)
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <a href="{{$picture->picture_path}}" title="{{$picture->name}}" data-gallery>
                    <img class="img-responsive" src="{{$picture->thumbnail_path}}" alt="{{$picture->name}}" title="{{$picture->name}}" />
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    
    <h4>Hozzászólások</h4>
    <div class="fb-comments" data-href="{{$url}}" data-width="100%" data-numposts="10" data-colorscheme="light"></div>

</div>
@stop