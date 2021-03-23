<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@if(!isset($book)) @lang('author.create_author') @else @lang('author.edit_author') @endif</h2>
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

<form action="@if(!isset($author)) {{ route('author.store') }} @else {{ route('author.update',$author->id) }}@endif" method="POST" enctype="multipart/form-data" id="createForm">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{trans('author.first_name')}}:</strong>
                <input type="text" name="first_name" @if(isset($author) &&$author->first_name) value="{{$author->first_name}}" @endif class="form-control" placeholder="{{trans('author.first_name')}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{trans('author.last_name')}}:</strong>
                <input type="text" name="last_name" @if(isset($author) &&$author->last_name) value="{{$author->last_name}}" @endif class="form-control" placeholder="{{trans('author.last_name')}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{trans('author.second_name')}}:</strong>
                <input type="text" name="second_name" @if(isset($author) &&$author->second_name) value="{{$author->second_name}}" @endif class="form-control" placeholder="{{trans('author.second_name')}}">
            </div>
        </div>
    </div>

</form>
