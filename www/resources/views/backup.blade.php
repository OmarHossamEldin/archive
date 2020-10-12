@extends('layout.app')
@section('title')
@lang('archive.app.name')
@endsection
@section('content')
<form action="\database/backup" method="GET">
<div class="form-group">
    <label for="file">@lang('archive.backup.backup_title')</label>
    <div class="row">
        <div class="col-8">
            <input type="file" webkitdirectory directory multiple name='backup_folder_path' class='form-control' required>
        </div>
        <div class="col-4">
            <button class='form-control btn btn-primary'>@lang('archive.backup.backup_button_title')</button>
        </div>
    </div>
</div>
</form>
<hr>
<form action="\backup" method="POST">
    <div class="form-group">
        <label for="file">@lang('archive.backup.restore_title')</label>
        <div class="row">
            <div class="col-8">
                <input type="file" name='file_path' class='form-control' required>
            </div>
            <div class="col-4">
                <button class='form-control btn btn-primary'>@lang('archive.backup.restore_button_title')</button>
            </div>
        </div>
    </div>
</form>
@endsection