@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('esemenyek.index')) }}
@stop

@section('content')

    @foreach($events as $event)
        <div class="item">
            <h1 class="content-title">{{HTML::link($event->getLink(),$event->title)}}</h1>

            <p class="item-datas">
                <i class="fa fa-clock-o"></i> {{$event->getStartAt()}} - {{$event->getEndAt()}}

            @if(count($event->tagNames()) > 0)
                <i class="fa fa-tags"></i>
                @foreach(\Divide\Helper\Tag::getTagByName($event->tagNames()) as $tag)
                    <span>{{HTML::linkRoute('esemenyek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                @endforeach
            @endif
            </p>

            <p class="item-shortcontent">
                {{$event->getParragraph()}}
            </p>
        </div>
    @endforeach

    <div class="text-center">
        {{$events->links();}}
    </div>

@stop