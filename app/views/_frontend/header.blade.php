<header>
    <div class="container">
        <img class="logo" src="{{URL::to("assets/smgkob_white_mini.svg")}}">
        <h1 class="title">{{HTML::linkRoute('fooldal',Setting::get('site-title'))}}</h1>
    </div>
</header>
<nav class="main-navbar">
    <div class="container">
        <ul>
            @include('_frontend.menu', array('items' => $mainMenu->roots()))
        </ul>
    </div>
</nav>