@extends('layout.app')
@section('title')
انشاء وثيقه
@endsection
@section('css')
@endsection
@section('content')
<form method='POST' action='\suitcase/{{$suitcase->id}}'>
    @csrf @method('PUT')
    <div class="form-group">
        <label for="serial">@lang('archive.suitcase.create.name')</label>
        <input type="text" name='name' class='form-control' value="{{$suitcase->name}}" required>
    </div>
    <div class="form-group">
        <label for="send_date">@lang('archive.suitcase.create.send_date')</label>
        <input type="text" name='send_date'  class='form-control date' value="{{$suitcase->send_date}}">
    </div>
    <div class="form-group">
        <label for="airline">@lang('archive.suitcase.create.airline')</label>
        <input type="text" name='airline'  class='form-control' value="{{$suitcase->airline}}">
    </div>
    <div class="form-group">
        <label for="weight">@lang('archive.suitcase.create.weight')</label>
        <input type='text' name='weight' class='form-control ' value="{{$suitcase->weight}}">
    </div>
    <div class="form-group">
        <label for="subject">@lang('archive.suitcase.create.current_flag')</label>
        <select class='form-control select' name='current_flag' value="{{$suitcase->name}}">
            @foreach($subjects as $subject)
            <option value="{{$subject->id}}">{{$subject->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="comment">@lang('archive.suitcase.create.comment')</label>
        <textarea name='comment' class='form-control'>{{ $suitcase->comment }}</textarea>
    </div>
    <div class="form-group">
            <div class="col-12">
            <button class='form-control btn btn-primary'>@lang('archive.suitcase.edit.submenu_title')</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')

@endsection
             
