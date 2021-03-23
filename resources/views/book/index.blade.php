@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right mb-5">
                <a class="btn btn-success" href="{{ route('book.create') }}"
                   onclick="addBook(this.href);return false">{{trans('book.create_book')}}</a>
                <a class="" href="{{url('/?sort='.$sort)}}@if(request()->filter)&filter={{request()->filter}} @endif">Сортировка
                    по названию @if($sort=='asc') 🔽 @else 🔼 @endif</a>
                <form action="{{url('/')}}" method="get"><input class="form-control" placeholder="search" type="text"
                                                                name="filter"
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
        @foreach ($books as $book)
            <div class="card" style="">
                <div class="row no-gutters">
                    <div class="col-sm-5">
                        <a href="{{route('book.show',$book->id)}}"><img class="card-img"
                                                                        src="{{asset("storage/image/$book->poster") }}"
                                                                        alt="Suresh Dasari Card"></a>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title">{{$book->name}}</h4>
                            <p class="card-text">{{$book->description}}</p>
                            <a href="#" onclick="addBook('{{route('book.edit',$book->id)}}');return false"
                               class="btn btn-primary">{{trans('book.edit')}}</a>
                            <form method="post" action="{{route('book.destroy',$book->id)}}">
                                @method('delete')
                                @csrf
                                <input type="submit" value="{{trans('book.deleted')}}" class="btn btn-danger">
                            </form>
                            <div>
                                @foreach($book->authors as $k=>$author)
                                    {{$author->first_name}} {{$author->last_name}} {{$author->second_name}}@if(count($book->authors)!=$k+1)
                                        , @endif
                                @endforeach
                            </div>
                            <div><small class="text-muted">{{$book->created_at}}</small></div>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach
    </table>

    {!! $books->links() !!}

@endsection



