@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('galeriak.show',$gallery)) }}
@stop

@section('content')
    <div class="gallery">

        <h1 class="content-title">{{$gallery->name}}</h1>

        @if($gallery->description)
            <h2 class="content-subtitle-2">Leírás</h2>
            <p>{{$gallery->description}}</p>
        @endif

        <div class="gallery-pictures">
            <ul class="row list-unstyled">
                @foreach($gallery->pictures as $picture)
                    <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                        <a href="{{$picture->picture_path}}" title="{{$picture->name}}" data-gallery>
                            <img class="img-responsive" src="{{$picture->thumbnail_path}}" alt="{{$picture->name}}"
                                 title="{{$picture->name}}"/>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

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
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by
                Disqus.</a></noscript>


    </div>
@stop