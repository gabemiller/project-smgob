@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('hirek.show',$article)) }}
@stop

@section('content')
    <div class="item">

        <h1 class="content-title">{{HTML::link($article->getLink(),$article->title)}}</h1>

        <div class="item-content">
            {{$article->content}}
        </div>

        <div class="item-infos">
            <div class="row">
                <div class="col-xs-12">
                    <div class="item-info"><i class="fa fa-clock-o"></i> {{$article->getCreatedAt()}}</div>
                    <div class="item-info">
                        @if(count($article->tagNames())>0)
                            <i class="fa fa-tags"></i>
                            @foreach(\Divide\Helper\Tag::getTagByName($article->tagNames()) as $tag)
                                <span>{{HTML::linkRoute('hirek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>


        @if(count($article->gallery)!=0 && count($article->gallery->pictures)!=0)
            <h4>Galéria</h4>

            <div class="item-gallery">
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

        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'szentmiklosovi'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function () {
                var dsq = document.createElement('script');
                dsq.type = 'text/javascript';
                dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>


    </div>
@stop