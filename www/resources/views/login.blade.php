@extends('layout.outside_app')
@section('title')
برنامج الأرشيف
@endsection
@section('content')
    <div class="row" style='margin-top:30px;text-align:center;'>
        <div class="col-md-2 col-2"></div>
        <div class="col-md-8 col-8">
            <form class="container" method="POST" action="">
                @csrf
                <img id='gymLogo' src="{{asset('/img/.jpg')}}" >
                <h3 style='display: inline;'>@lang('archive.login.header')</h3><br><br>
                <input  id="password" class='form-control'  dir=rtl type="password" placeholder="كلمة المرور" name="password" required autocomplete='off'><br>
                <input type="submit" class="form-control btn btn-dark" name="Login" value="@lang('archive.login.button')"><br><br>
                <a href='#' style='color:#000000'>@lang('archive.login.forget')</a>
            </form>
        </div>
        <div class="col-md-1 col-1"></div>
    </div>
@endsection