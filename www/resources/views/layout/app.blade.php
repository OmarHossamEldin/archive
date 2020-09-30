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
        <link rel="stylesheet" href="{{asset('css/daterangepicker.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
        @yield('css')
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="col-12 header">
    <div class="row">
            <div class='col-1'>
            <select class='form-control locale-changer'>
                <option val='en'>English</option>  
                <option val='ar'>العربية</option> 
            </select>
            </div> 
            <div class='col-1'></div>
            <div class='col-8'>
            <h3 class='brand'><a href="/">@lang('archive.app.name')</a></h3>
            </div>
            <div class='col-2'><i class='fa fa-sign-out'></i></div>
        </div>
    </div>
    <!-- sidebar -->
    <div class='sidebar' lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
        <a  class='' href="#">@lang('archive.sidebar.document')</a>
        <a class='' href="" >@lang('archive.sidebar.organization')</a>
        <a class='' href="#">@lang('archive.sidebar.subject')</a>
        <a class='' href="#">@lang('archive.sidebar.suitcase')</a>
    </div>
    <!-- sidebar -->
    <div class="row-header">
        <div class='col-12'>
            @include('inc.message')
        </div>
    </div>
    <div class="container" style="margin-top: 15px;">
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
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/jquery.daterangepicker.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/globalebackend.js')}}"></script>
    <!-- <script>
        $('.locale-changer').change(function(){
            {{ str_replace('_', '-', app()->getLocale()) == "en" ? app()->setLocale('en') : app()->setLocale('en') }}
            location.reload()
        })
    </script> -->
    @yield('js')
    </body>
</html>