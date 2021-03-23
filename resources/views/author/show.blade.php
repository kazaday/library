@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('author.index') }}"> {{trans('pagination.previous')}}</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>!!!</strong>{{trans('validation.not_all_input')}}<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <img src="{{asset("storage/image/$author->poster") }}" class="img-fluid figure-img">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            {!!$author->name!!}
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            {!!$author->description!!}
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                @foreach($author->authors as $k=>$author)
                    {{$author->first_name}} {{$author->last_name}} {{$author->second_name}}@if(count($author->authors)!=$k+1)
                        , @endif
                @endforeach
            </div>
        </div>
    </div>

@endsection
