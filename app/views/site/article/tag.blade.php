@extends('_frontend.master')

@section('page-title')
    <h1>Hírek</h1>
@stop

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('hirek.tag',$tag)) }}
@stop

@section('content')

    @foreach($articles as $article)
        <div class="article list-box">
            <h3>{{HTML::link($article->getLink(),$article->title)}}</h3>

            <p class="article-datas">
                <i class="fa fa-user"></i> {{$article->getAuthorName()}} <i class="fa fa-clock-o"></i>
                {{$article->getCreatedAt() }}

                @if(sizeof($article->tagNames()) > 0)
                    <i class="fa fa-tags"></i>
                    @foreach(\Divide\Helper\Tag::getTagByName($article->tagNames()) as $tag)
                        <span>{{HTML::linkRoute('hirek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                    @endforeach
                @endif
            </p>
        </div>
    @endforeach

    <div class="text-center">
        {{$articles->links();}}
    </div>

@stop