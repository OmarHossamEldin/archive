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
        <textarea name='description' class='form-control' required >{{$document->description}}</textarea>
    </div>
    <div class="form-group">
        <label for="date">@lang('archive.document.create.date')</label>
        <input name='date' class='form-control date' required value='{{$document->date}}'>
    </div>
    <div class="form-group">
        <label for="organization">@lang('archive.document.create.organization')</label>
        <select class='form-control select' name='organization_id' required>
            <option value="{{$document->organization->id}}">{{$document->organization->name}}</option>
            @foreach($organizations as $organization)
            @if($organization != $document->organization)
            <option value="{{$organization->id}}">{{$organization->name}}</option>
            @endif
            @endforeach
        </select>
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
        <label for="suitcase">@lang('archive.global.suitcase')</label>
        <select class='form-control select' name='suit_cases_id' required>
            <option value="{{$document->suit_case->id}}">{{$document->suit_case->name}}</option>
            @foreach($suitcases as $suitcase)
            @if($suitcase != $document->suit_case)
            <option value="{{$suitcase->id}}">{{$suitcase->name}}</option>
            @endif
            @endforeach
        </select>
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