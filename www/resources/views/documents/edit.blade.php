@extends('layout.app')
@section('title')
انشاء وثيقه
@endsection
@section('css')
@endsection
@section('content')
<form method='POST' action='\document\{{$document->id}}' enctype='multipart/form-data'>
    @csrf @method('PUT')
    <div class="form-group">
        <label for="type">@lang('archive.document.create.type.title')</label>
        <div class="row">
            <div class="col-1">
                <label for="type">@lang('archive.document.create.type.import')</label><br>
                <input type="radio" id="import" class='type' name="type" value="{{$document->type}}" checked disabled>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="description">@lang('archive.document.create.description')</label>
        <textarea name='description' class='form-control'>{{$document->description}}</textarea>
    </div>
    <div class="form-group">
        <label for="date">@lang('archive.document.create.date')</label>
        <input name='date' class='form-control date' required value='{{$document->date}}'>
    </div>
    <div class="form-group">
        <label for="organization">@lang('archive.document.create.organization')</label>
        <input type='text' class='form-control' value="{{$document->organization->name}}" disabled>
    </div>
    <div class="form-group">
        <label for="subject">@lang('archive.global.subject')</label>
        <select class='form-control select' name='subject_id' required>
            <option value="{{$document->subject->id}}">{{$document->subject->name}}</option>
            @foreach($subjects as $subject)
            @if($subject != $document->subject->name)
            <option value="{{$subject->id}}">{{$subject->name}}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="suitcase">@lang('archive.document.edit.current_suitcase')</label>
        <div class="row col-12">
            <input type="text" class="form-control" name='suit_cases_id' value="{{ $document->suit_case->name }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="suitcase">@lang('archive.document.edit.active_suitcase')</label>
        <div class="row col-12">
            <input type="text" class="form-control" value="{{ $active_suitcase == null ? Lang::get('archive.suitcase.active.not_available') : $active_suitcase->name }}" readonly>
            <input type="hidden" name="suit_cases_id" value="{{ $active_suitcase->id }}">
        </div>
    </div>
    <div class="row col-12">
        <p class='caution'>@lang('archive.document.edit.active_suitcase_caution')</p>
    </div>

    <div class="form-group">
        @if($document->file_path != null)
        <div class="row col-12">
            <label>@lang('archive.document.edit.file'): {{ $document->file_path }}</label>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <label for="file">@lang('archive.document.create.file')</label>
            </div>
            <div class="row col-12">
                <div class="col-8">
                    <input type="file" name='file_path' class='form-control'>
                </div>
                <div class="col-4">
                    <button class='form-control btn btn-primary'>@lang('archive.document.edit.submenu_title')</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')

@endsection