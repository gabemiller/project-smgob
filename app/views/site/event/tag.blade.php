@extend('_frontend.master')
@section('page-title')
    <h1>Események</h1>
@stop

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('esemenyek.tag',$tag)) }}
@stop

@section('content')

    @foreach($events as $event)
        <div class="event list-box">
            <h3>{{HTML::link($event->getLink(),$event->title)}}</h3>

            <p class="event-datas">
                <i class="fa fa-clock-o"></i> {{$event->getStartAt()}} - {{$event->getEndAt()}}

                @if(count($event->tagNames()) > 0)
                    <i class="fa fa-tags"></i>
                    @foreach(\Divide\Helper\Tag::getTagByName($event->tagNames()) as $tag)
                        <span>{{HTML::linkRoute('esemenyek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                    @endforeach
                @endif
            </p>
        </div>
    @endforeach

    <div class="text-center">
        {{$events->links();}}
    </div>

@stop