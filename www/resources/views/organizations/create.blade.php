@extends('layout.app')
@section('title')
انشاء وثيقه
@endsection
@section('css')
@endsection
@section('content')
<form method='post' action='\organization'>
    @csrf
    <div class="form-group">
        <label for="organization">@lang('archive.organization.create.organization')</label>
        <input type="text" name='name' class='form-control' required>
    </div>
    <div class="form-group">
        <label for="organization">@lang('archive.organization.create.parent_organization')</label>
        <select class='form-control select' name='organization_id'>
            <option></option>
            @foreach($organizations as $organization)
                <option value='{{$organization->id}}'>{{ $organization->name }}</option>
            @endforeach 
        </select>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12">
            <button class='form-control btn btn-primary'>@lang('archive.document.button_title')</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')

@endsection
             
