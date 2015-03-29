@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('oldalak.show',$page)) }}
@stop

@section('content')
    <div class="page">

        <h1 class="content-title">{{$page->title}}</h1>

        <div class="page-content">
            {{$page->content}}
        </div>

        @if(count($page->gallery)!=0 && count($page->gallery->pictures)!=0)
            <h4>Galéria</h4>
            <div class="page-gallery">
                <div class="owl-carousel">
                    @foreach($article->gallery->pictures as $picture)
                        <div>
                            <a href="{{$picture->picture_path}}" title="{{$picture->name}}" data-gallery>
                                <img class="img-responsive" src="{{$picture->thumbnail_path}}" alt="{{$picture->name}}"
                                     title="{{$picture->name}}"/>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
@stop