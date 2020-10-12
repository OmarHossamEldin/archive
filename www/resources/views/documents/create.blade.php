@extends('layout.app')
@section('title')
انشاء وثيقه
@endsection
@section('css')
@endsection
@section('content')
<form method='POST' action='\document' enctype='multipart/form-data'>
    @csrf
    <div class="form-group">
        <label for="type">@lang('archive.document.create.type.title')</label>
        <div class="row">
            <div class="col-1">
                <label for="type">@lang('archive.document.create.type.import')</label><br>
                <input type="radio" id="import" class='type' name="type" value="@lang('archive.document.create.type.import')" checked>
            </div>
            <div class="col-1">
                <label for="type">@lang('archive.document.create.type.export')</label><br>
                <input type="radio" id="export" class='type' name="type" value="@lang('archive.document.create.type.export')">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="description">@lang('archive.document.create.description')</label>
        <textarea name='description' class='form-control'></textarea>
    </div>
    <div class="form-group">
        <label for="date">@lang('archive.document.create.date')</label>
        <input name='date' class='form-control date' required>
    </div>
    <div class="form-group">
        <label for="organization">@lang('archive.document.create.organization')</label>
        <select class='form-control select organization-selector' name='organization_id' required>
            @foreach($organizations as $organization)
            <option class="organization" rootid="{{$organization->root != null ? $organization->root->id : null}}" value="{{$organization->id}}">{{$organization->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="type">@lang('archive.document.create.serial')</label>
        <input type="number" id="serial" class='form-control' disabled value="">
    </div>
    <div class="form-group">
        <label for="subject">@lang('archive.global.subject')</label>
        <select class='form-control select' name='subject_id' required>
            @foreach($subjects as $subject)
            <option value="{{$subject->id}}">{{$subject->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="suitcase">@lang('archive.document.edit.active_suitcase')</label>
        <div class="row col-12">
            <input type="text" class="form-control" name='suit_cases_id' value="{{ $active_suitcase == null ? Lang::get('archive.suitcase.active.not_available') : $active_suitcase->name }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="file">@lang('archive.document.create.file')</label>
        <div class="row">
            <div class="col-8">
                <input type="file" name='file_path' class='form-control'>
            </div>
            <div class="col-4">
                <button class="form-control btn btn-primary" {{ $active_suitcase == null ? 'disabled' : ''}}>@lang('archive.document.button_title')</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
@endsection