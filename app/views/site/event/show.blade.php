@extend('_frontend.master')
@section('breadcrumb')
{{ HTML::decode(Breadcrumbs::render('esemenyek.show',$event)) }}
@stop
@section('content')

<div class="event">
    <h1>{{HTML::link($event->getLink(),$event->title)}}</h1>
    <p class="small">Kezdés: {{$event->start}} | Befejezés: {{$event->end}} </p>
    <div class="event-content">
        {{$event->content}}
    </div>

    @if(count($event->gallery)!=0 && count($event->gallery->pictures)!=0)
    <h4>Galéria</h4>
    <div class="event-gallery">
        <ul class="row list-unstyled">
            @foreach($event->gallery->pictures as $picture)
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <a href="{{$picture->picture_path}}" title="{{$picture->name}}" data-gallery>
                    <img class="img-responsive" src="{{$picture->thumbnail_path}}" alt="{{$picture->name}}" title="{{$picture->name}}" />
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <h4>Hozzászólások</h4>

    <div class="fb-comments" data-href="{{$url}}" data-width="100%" data-numposts="10" data-colorscheme="light"></div>
</div>
@stop