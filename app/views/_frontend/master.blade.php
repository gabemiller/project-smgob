<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns#">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">


    <link href="/assets/favicon.ico" rel="icon" type="image/x-icon"/>
    <title>{{Setting::get('site-title')}} @if(!empty($title)) {{'- '.$title }} @endif</title>

    <!--[if lt IE 9]>
    {{ HTML::script('//html5shim.googlecode.com/svn/trunk/html5.js'); }}
    <![endif]-->

    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('css/divide.min.css'); }}

</head>
<body>
<div id="fb-root"></div>

@include('_frontend.lightbox')
@include('_frontend.header')
<div class="container main-container">
    <div class="row">
        <div class="col-xs-12">
            @yield('breadcrumb')
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <img class="img-responsive" src="{{URL::to('assets/szm.jpg')}}">
            @yield('sidebar')
            <div class="hidden-xs hidden-sm">
                <h4>Kövessen Facebookon!</h4>

                <div class="fb-like-box" data-href="https://www.facebook.com/szentmiklosgorkatovodaesbolcsode"
                     data-colorscheme="light"
                     data-show-faces="true" data-header="false" data-show-border="false" data-width="270"></div>
            </div>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
@include('_frontend.footer')


{{ HTML::script('js/jquery-2.1.1.min.js'); }}
{{ HTML::script('js/bootstrap.min.js'); }}
{{ HTML::script('js/divide.min.js'); }}


<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&appId=567582800013985&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>
