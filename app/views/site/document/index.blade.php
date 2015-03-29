@extends('_frontend.master')

@section('breadcrumb')
    @if(count($category))
        {{HTML::decode(Breadcrumbs::render('dokumentumok.category',$category))}}
    @else
        {{HTML::decode(Breadcrumbs::render('dokumentumok.index'))}}
    @endif
@stop

@section('sidebar')
    <h3>Kategóriák</h3>
    <ul class="list-unstyled list-category">
        <li>{{HTML::linkRoute('dokumentumok.index','Összes kategória')}}</li>
        @foreach($categories as $cat)
            <li>{{HTML::linkRoute('dokumentumok.index',$cat->name.' ('.$cat->documents->count().')',array('slug'=>$cat->slug))}}
            </li>
        @endforeach
    </ul>
@stop

@section('content')
    <div class="documents">

        <h1 class="content-title">Letölthető dokumentumok</h1>
        @if(count($category))
            <h2 class="content-subtitle-2">{{$category->name}}</h2>
        @endif

        <div class="table-responsive">
            <table class="table table-middle">
                <thead>
                    <tr>
                        <th>Dokumentum</th>
                        <th class="table-col-sm">Feltöltve</th>
                        <th class="table-col-sm">Módosítva</th>
                        <th class="table-col-xs"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($documents as $doc)
                    <tr>
                        <td>
                            <h4>{{$doc->name}}</h4>

                            <p>{{$doc->description}}</p>

                            <p>
                                @foreach($doc->categories as $category)
                                    <span class="label label-cherryred">{{$category->name}}</span>
                                @endforeach
                            </p>
                        </td>
                        <td>{{$doc->getCreatedAt('Y.m.d.')}}</td>
                        <td>{{$doc->getUpdatedAt('Y.m.d.')}}</td>
                        <td>
                            {{HTML::decode(HTML::link($doc->path,'Letöltés',array('class'=>'btn btn-small
                            btn-default','target'=>'_blank')))}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop