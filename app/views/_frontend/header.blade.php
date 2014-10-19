<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{HTML::linkRoute('fooldal',Setting::get('site-title'),array(),array('class'=>'navbar-brand'))}}
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {{--$mainMenu->asUl(array('class'=>'nav navbar-nav navbar-right'))--}}
            <ul class="nav navbar-nav navbar-right">
                @include('_frontend.menu', array('items' => $mainMenu->roots()))
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<header>
    <div class="bg-darker">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @yield('page-title')
                </div>
            </div>
        </div>
    </div>
</header>