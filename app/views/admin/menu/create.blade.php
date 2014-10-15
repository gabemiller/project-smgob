@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Menüpontok</h1>
    {{-- HTML::decode(Breadcrumbs::render('')) --}}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">

            {{Form::open(array('url' => URL::route('admin.menu-kezelo.store',array()),'method'=>'POST'))}}
            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Új menüpont</h3>
                </div>
                <div class="box-body">

                    <div class="form-group hidden">
                        {{Form::label('menu_id', 'Menü',array('class'=>'control-label'))}}
                        <div>
                            {{Form::selection('menu_id', $menus,array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('parent_id', 'Szülő menüpont',array('class'=>'control-label'))}}
                        <div>
                            {{Form::selection('parent_id', $parents,array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('name', 'Név',array('class'=>'control-label'))}}
                        <div>
                            {{Form::input('text','name','',array('class'=>'form-control','placeholder'=>'Név'))}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('type', 'Típus',array('class'=>'control-label'))}}
                        <div>
                            {{Form::selection('type', $types,array('class'=>'form-control'))}}
                        </div>
                    </div>

                    <ul class="nav nav-tabs hidden" role="tablist">
                        <li class="active"><a href="#menu-1" role="tab" data-toggle="tab">{{$types[1]}}</a></li>
                        <li><a href="#menu-2" role="tab" data-toggle="tab">{{$types[2]}}</a></li>
                        <li><a href="#menu-3" role="tab" data-toggle="tab">{{$types[3]}}</a></li>
                        <li><a href="#menu-4" role="tab" data-toggle="tab">{{$types[4]}}</a></li>
                        <li><a href="#menu-5" role="tab" data-toggle="tab">{{$types[5]}}</a></li>
                        <li><a href="#menu-6" role="tab" data-toggle="tab">{{$types[6]}}</a></li>
                        <li><a href="#menu-7" role="tab" data-toggle="tab">{{$types[7]}}</a></li>
                        <li><a href="#menu-8" role="tab" data-toggle="tab">{{$types[8]}}</a></li>
                        <li><a href="#menu-8" role="tab" data-toggle="tab">{{$types[9]}}</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="menu-1"></div>
                        <div class="tab-pane" id="menu-2">
                            <div class="form-group">
                                {{Form::label('url', 'Külső hivatkozás',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::input('text','url','',array('class'=>'form-control','placeholder'=>'Külső
                                    hivatkozás'))}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="menu-3">
                            <div class="form-group">
                                {{Form::label('tag', 'Címke',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::selection('tag', $types,array('class'=>'form-control'))}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="menu-4">
                            <div class="form-group">
                                {{Form::label('article_id', 'Bejegyzés',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::selection('article_id', $types,array('class'=>'form-control'))}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="menu-5">
                            <div class="form-group">
                                {{Form::label('tag', 'Címke',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::selection('tag', $types,array('class'=>'form-control'))}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="menu-6">
                            <div class="form-group">
                                {{Form::label('event_id', 'Esemény',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::selection('event_id', $types,array('class'=>'form-control'))}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="menu-7"></div>
                        <div class="tab-pane" id="menu-8">
                            <div class="form-group">
                                {{Form::label('gallery_id', 'Galéria',array('class'=>'control-label'))}}
                                <div>
                                    {{Form::selection('gallery_id', $types,array('class'=>'form-control'))}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="menu-9"></div>
                    </div>

                </div>
                <div class="box-footer">
                    {{Form::submit('Mentés',array('class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>
            {{Form::close()}}

        </div>

        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">

            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Menüpontok</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table-sortable">
                            <thead>
                            <tr>
                                <th class="table-col-xs sorter-false filter-false"><input type="checkbox" id="checkAll">
                                </th>
                                <th class="table-col-xs">Az</th>
                                <th class="table-col-xs">Sz_Az</th>
                                <th>Név</th>
                                <th>Url</th>
                                <th>Létrehozva</th>
                                <th>Módosítva</th>
                                <th class="table-col-xs sorter-false filter-false">Beállítások</th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('admin.menu.single',$menuItems,'menu','admin.menu.empty')
                            </tbody>
                            @include('_backend.table-footer')
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@stop