@extends('layout.app')
@section('title')
الوثائق
@endsection
@section('content')
@csrf
    <div class="form-group">
        <label for="serial">رقم المسلسل</label>
        <input type="text" name='serial' class='form-control' required>
    </div>
@endsection