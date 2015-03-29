@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('fooldal')) }}
@stop

@section('content')

    @foreach($articles as $article)
        <div class="item">
            <h1 class="content-title">{{HTML::link($article->getLink(),$article->title)}}</h1>

            <p class="item-datas">
                <i class="fa fa-clock-o"></i>
                {{$article->getCreatedAt() }}

                @if(sizeof($article->tagNames()) > 0)
                    <i class="fa fa-tags"></i>
                    @foreach(\Divide\Helper\Tag::getTagByName($article->tagNames()) as $tag)
                        <span>{{HTML::linkRoute('hirek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                    @endforeach
                @endif
            </p>

            <p class="item-content">
                {{$article->getParragraph()}}
            </p>

        </div>
    @endforeach

    <div class="text-center">
        {{$articles->links();}}
    </div>

@stop