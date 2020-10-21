<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title',"@lang('archive.app.name')")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/daterangepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/treeview.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
    <!-- JavaScripts -->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jqwidgets/jqxcore.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jqwidgets/jqxbuttons.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jqwidgets/jqxscrollbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jqwidgets/jqxpanel.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jqwidgets/jqxtree.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jqwidgets/jqxexpander.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/jquery.daterangepicker.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/operation.js')}}"></script>
    <script src="{{asset('js/jquery.PrintArea.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/globalebackend.js')}}"></script>
    <!--  -->
    @yield("script")
</head>

<body>
    <div class="container-fluid projectContainer" dir="{{ str_replace('_', '-', app()->getLocale()) == 'en' ? 'ltr' : 'rtl' }}">
        <div class="row">
            <div class="col-12 header">
                <div class="row">
                    <div class="col-10">
                        <a href='\document'>
                            <h3>@lang('archive.app.name')</h3>
                        </a>
                    </div>
                    <div class="col-2">
                        <form  method='post' action='/lang'>
                            @csrf
                            <select name='lang' class='locale-changer'>
                                <option value='en'>English</option>
                                <option value='ar'>العربية</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 dashbordManu">
                <ul>
                    <li class="documentDashboard">
                        <span>@lang('archive.sidebar.document') <i class="fas fa-caret-down"></i></span>
                        <ul class="salesSubDash">
                            <li><a href="\document/create">@lang('archive.document.submenus.create')</a></li>
                            <li><a href="\document">@lang('archive.document.submenus.index')</a></li>
                        </ul>
                    </li>
                    <li class="organizationDashboard">
                        <span>@lang('archive.sidebar.organization')<i class="fas fa-caret-down"></i></span>
                        <ul class="purchasesSubDash">
                            <li><a href="\organization/create">@lang('archive.organization.submenus.create')</a></li>
                            <li><a href="\organization">@lang('archive.organization.submenus.index')</a></li>
                        </ul>
                    </li>
                    <li class="subjectDashboard">
                        <span>@lang('archive.sidebar.subject') <i class="fas fa-caret-down"></i></span>
                        <ul class="stockSubDash">
                            <li><a href="\subject/create">@lang('archive.subject.submenus.create')</a></li>
                            <li><a href="\subject">@lang('archive.subject.submenus.index')</a></li>
                        </ul>
                    </li>
                    <li class="suitcaseDashboard">
                        <span>@lang('archive.sidebar.suitcase') <i class="fas fa-caret-down"></i></span>
                        <ul class="suitcaseDashboardSubDash">
                            <li><a href="\suitcase/create">@lang('archive.suitcase.submenus.create')</a></li>
                            <li><a href="\suitcase">@lang('archive.suitcase.submenus.index')</a></li>
                        </ul>
                    </li>
                    <hr>
                    <li class="logout">
                        <a href="{{route('logout')}}">
                            <span><i class="fas fa-sign-out-alt"></i> @lang('archive.global.logout_btn')</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-7 container" style='padding: 10pt;'>
                @include('inc.message')
                @yield('content')
            </div>
            <div class="col-3 treeview" style="display: none">
                <div id='jqxExpander'>
                    <div>
                        @lang('archive.sidebar.organization')
                    </div>
                    <div>
                        <div style="border: none;" id='jqxTree'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 footerapp">
                <h6>@lang('archive.copyright') &copy; <script>
                        let time = new Date().getFullYear();
                        document.write(time + 1);
                        document.write('-');
                        document.write(time);
                    </script>
                </h6>
            </div>
        </div>
    </div>
</body>

</html>