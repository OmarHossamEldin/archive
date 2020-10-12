@extends('layout.app')
@section('title')
انشاء وثيقه
@endsection
@section('css')
@endsection
@section('content')
<form method='post' action='\subject/{{$subject->id}}'>
    @csrf @method('PUT')
    <div class="form-group">
        <label for="name">@lang('archive.subject.create.subject')</label>
        <input type="text" name='name' class='form-control' required value="{{$subject->name}}">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12">
            <button class='form-control btn btn-primary'>@lang('archive.subject.edit.submenu_title')</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')

@endsection
             
