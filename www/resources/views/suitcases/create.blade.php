@extends('layout.app')
@section('title')
انشاء وثيقه
@endsection
@section('css')
@endsection
@section('content')
<form method='POST' action='\suitcase'>
    @csrf
    <div class="form-group">
        <label for="serial">@lang('archive.suitcase.create.name')</label>
        <input type="text" name='name' class='form-control' required pattern="[^\.\\\?؟]*">
        <p class='caution'>@lang('archive.suitcase.create.name_caution')</p>
    </div>
    <div class="form-group">
        <label for="send_date">@lang('archive.suitcase.create.send_date')</label>
        <input type="text" name='send_date'  class='form-control date'>
    </div>
    <div class="form-group">
        <label for="airline">@lang('archive.suitcase.create.airline')</label>
        <input type="text" name='airline'  class='form-control '>
    </div>
    <div class="form-group">
        <label for="weight">@lang('archive.suitcase.create.weight')</label>
        <input type='text' name='weight' class='form-control '>
    </div>
    <div class="form-group">
        <label for="current_flag">@lang('archive.suitcase.create.current_flag')</label>
        <input type="checkbox" class='current_flag' disabled checked>
    </div>
    <div class="form-group">
        <label for="comment">@lang('archive.suitcase.create.comment')</label>
        <textarea name='comment' class='form-control'></textarea>
    </div>
    <div class="form-group">
            <div class="col-12">
            <button class='form-control btn btn-primary'>@lang('archive.suitcase.create.submenu_title')</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')

@endsection
             
