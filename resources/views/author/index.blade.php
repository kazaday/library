@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right mb-5">
                <a class="btn btn-success" href="{{ route('author.create') }}"
                   onclick="addBook(this.href);return false">{{trans('author.create_author')}}</a>
                <a class=""
                   href="{{url('/authors/?sort='.$sort)}}@if(request()->filter)&filter={{request()->filter}} @endif">Сортировка
                    по названию @if($sort=='asc') 🔽 @else 🔼 @endif</a>
                <form action="{{url('/authors/')}}" method="get"><input class="form-control" placeholder="search"
                                                                        type="text" name="filter"
                                                                        value="@if(request()->filter){{request()->filter}}@endif">
                    <input type="submit" hidden></form>
            </div>
        </div>
    </div>
    <div id="validation-errors">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
    <table class="table table-bordered">
        @foreach ($authors as $author)
            <div class="card" style="">
                <div class="row no-gutters">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title">{{$author->first_name}} {{$author->last_name}} {{$author->second_name}}</h4>
                            <a href="{{route('author.edit',$author->id)}}" onclick="addBook(this.href);return false"
                               class="btn btn-primary">{{trans('author.edit')}}</a>
                            <form method="post" action="{{route('author.destroy',$author->id)}}">
                                @method('delete')
                                @csrf
                                <input type="submit" value="{{trans('author.deleted')}}" class="btn btn-danger">
                            </form>
                            <div><small class="text-muted">{{$author->created_at}}</small></div>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach
    </table>

    {!! $authors->links() !!}

@endsection



