<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@if(!isset($book)) @lang('book.create_book') @else @lang('book.edit_book') @endif</h2>
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

<form action="@if(!isset($book)) {{ route('book.store') }} @else {{ route('book.update',$book->id) }}@endif" method="POST" enctype="multipart/form-data" id="createForm">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{trans('book.name')}}:</strong>
                <input type="text" name="name" @if(isset($book) &&$book->name) value="{{$book->name}}" @endif class="form-control" placeholder="{{trans('book.name')}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{trans('book.description')}}:</strong>
                <input type="text" name="description" @if(isset($book) &&$book->description) value="{{$book->description}}" @endif class="form-control" placeholder="{{trans('book.description')}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{trans('book.author')}}:</strong>
                <select multiple name="author[]" class="form-control">
                    @foreach($authors as $author)
                        <option @if(isset($book))
                                    @foreach($book->authors as $row) @if($row->id==$author->id) selected @endif @endforeach
                                @endif
                            value="{{$author->id}}">{{$author->first_name}} {{$author->last_name}} {{$author->second_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{trans('book.poster')}}:</strong>
                <input type="file" name="poster" class="form-control" placeholder="{{trans('book.poster')}}">
            </div>
        </div>
    </div>

</form>
