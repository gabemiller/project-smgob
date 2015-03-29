@extends('_frontend.master')

@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('galeriak.index')) }}
@stop

@section('content')
    <div class="gallery">

        <h1 class="content-title">Galériák</h1>

        <ul class="row list-unstyled">
            @foreach($galleries as $gallery)
                @if(count($gallery->pictures)>0)
                    <li class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="gallery-item">
                            {{HTML::decode(HTML::linkRoute('galeriak.show','<img class="img-responsive" src="'.$gallery->pictures->first()->thumbnail_path.'" alt="'.$gallery->name.'" title="'.$gallery->name.'" />',array('id'=>$gallery->id,'title'=>$gallery->getSlugName())))}}
                            {{HTML::decode(HTML::linkRoute('galeriak.show','<h1>'.$gallery->name.'</h1>',array('id'=>$gallery->id,'title'=>$gallery->getSlugName())))}}
                            @if(strlen($gallery->getDescription())>0)
                                <p>{{$gallery->getDescription()}}</p>
                            @endif
                            <p class="small text-muted gallery-update">Frissítve: {{$gallery->getUpdateDate()}}</p>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>

        <div class="text-center">
            {{$galleries->links();}}
        </div>
    </div>
@stop