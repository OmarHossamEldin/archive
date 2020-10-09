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
        <select class='form-control select' name='organization_id' selected='{{$organization->organization_id}}' required>
            @if($organization->parent != null)
            <option value='{{$organization->parent->id}}'>{{ $organization->parent->name }}</option>
                @foreach($organization_global as $organization_item)
                @if($organization_item->id != $organization->id && $organization_item->id != $organization->parent->id)
                <option value='{{$organization_item->id}}'>{{ $organization_item->name }}</option>
                @endif
                @endforeach
            @else
            <option value='null'>@lang('archive.global.not_available')</option>
            @foreach($organization_global as $organization_item)
            @if($organization_item->id != $organization->id)
                <option value='{{$organization_item->id}}'>{{ $organization_item->name }}</option>
            @endif
            @endforeach    
            @endif
            
        </select>
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