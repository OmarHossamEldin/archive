@extends('layout.outside_app')
@section('title')
@lang('archive.app.name')
@endsection
@section('content')
    <div class="row" style='margin-top:30px;text-align:center;'>
        <div class="col-md-2 col-2"></div>
        <div class="col-md-8 col-8">
            <form class="container" method="POST" action="\login">
                @csrf
                <img id='gymLogo' width='15%' src="{{asset('/img/archive.png')}}" >
                <h3 style='display: inline;'>@lang('archive.login.header')</h3><br><br>
                <input  id="password" class='form-control'  dir=rtl type="password" placeholder="كلمة المرور" name="password" required autocomplete='off'><br>
                <input type="submit" class="form-control btn btn-dark" name="Login" value="@lang('archive.login.button')"><br><br>
            </form>
        </div>
        <div class="col-md-1 col-1"></div>
    </div>
@endsection