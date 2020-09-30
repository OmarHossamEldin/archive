<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', "@lang('archive.app.name')")</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/gymstyle.css')}}">
    </head>
    <body>
    <div class="col-12 header">
       <h3 class='brand'><a href="/">@lang('archive.app.name')</a></h3>
    </div>
    <div class="row-header">
        <div class='col-12'>
            @include('inc.message')
        </div>
    </div>
    <div class="container app">
        @yield('content')
    </div>
    <div class="col-12 footer">
        <div class="row" style='margin-top:20px;'>
            <div class='col-2'></div> 
            <div class='col-8'>
                <h6>@lang('archive.copyright') &copy; <script>let time=new Date().getFullYear(); document.write (time+1); document.write ('-');document.write (time);</script></h6>
            </div>
            <div class='col-2'>@lang('archive.app.version')
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>