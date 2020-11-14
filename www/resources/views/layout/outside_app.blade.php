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
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    @yield("script")
</head>

<body>
    <div class="row">
        <div class="col-12 header">
            <div class="row">
                <div class="col-10">
                    <a href='\document'>
                        <h3>@lang('archive.app.name')</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style='margin-top:150pt'>
        @include('inc.message')
        @yield('content')
    </div>
    <div class="col-12 footer">
        <div class="row col-12">
            <div class="col-4">
                @lang('archive.app.version')
            </div>
            <div class="col-4">
                <h6>@lang('archive.copyright') &copy; <script>
                        let time = new Date().getFullYear();
                        document.write(time + 1);
                        document.write('-');
                        document.write(time);
                    </script>
                </h6>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</body>
</html>