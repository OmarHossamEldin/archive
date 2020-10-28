@extends('layout.app')
@section('title')
تعديل الجهة
@endsection
@section('css')
@endsection
@section('content')
<form method='post' action='\organization/{{$organization->id}}'>
    @csrf
    @method('patch')
    <div class="form-group">
        <label for="organization">@lang('archive.organization.create.organization')</label>
        <input type="text" name='name' class='form-control' value='{{$organization->name}}' required>
    </div>
    <div class="form-group">
        <label for="organization">@lang('archive.organization.create.parent_organization')</label>
        <input type="text" class='form-control' value='{{$organization->parent != null ? $organization->parent->name : ""}}' readonly>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-12">
                <button class='form-control btn btn-primary'>@lang('archive.organization.edit.submenu_title')</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')

@endsection