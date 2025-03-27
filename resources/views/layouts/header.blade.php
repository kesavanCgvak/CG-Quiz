<!DOCTYPE html>
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token()}}">

    <title>{{ config('app.name') }} :: {{ $title }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> -->

    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <link rel="shortcut icon" href="{{Url('public/img/favicon.png')}}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{Url('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{Url('public/css/fullcalendar.css')}}" />
    <link rel="stylesheet" href="{{Url('public/css/plugins.css')}}">
    <link rel="stylesheet" href="{{Url('public/css/main.css')}}">
    <link rel="stylesheet" href="{{Url('public/css/themes.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <!-- Modernizr (browser feature detection library) -->
    <script src="{{Url('public/js/vendor/modernizr-3.3.1.min.js')}}"></script>
    <script src="{{Url('public/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{Url('public/js/vendor/jquery.validate.js')}}"></script>
    <script src="{{Url('public/js/pages/readyDashboard.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


    {{--jquery Multiselect--}}
    <link href="{{url('public/css/jquery.multiselect.css')}}" rel="stylesheet" />
    <script src="{{Url('/public/js/jquery.multiselect.js')}}"></script>
</head>

<body>
    <div id="page-wrapper" class="page-loading">
        <!-- Preloader -->
        <div class="preloader">
            <div class="inner">
                <!-- Animation spinner for all modern browsers -->
                <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

                <!-- Text for IE9 -->
                <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
            </div>
        </div>

        <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
            <!-- Alternative Sidebar -->
            <div id="sidebar-alt" tabindex="-1" aria-hidden="true">
                <!-- Toggle Alternative Sidebar Button (visible only in static layout) -->
                <a href="javascript:void(0)" id="sidebar-alt-close" onclick="App.sidebar('toggle-sidebar-alt');"><i
                        class="fa fa-times"></i></a>

                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-scroll-alt">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Profile -->
                        <div class="sidebar-section">
                            <h2 class="text-light">Profile</h2>
                            <form action="index.html" method="post" class="form-control-borderless"
                                onsubmit="return false;">
                                <div class="form-group">
                                    <label for="side-profile-name">Name</label>
                                    <input type="text" id="side-profile-name" name="side-profile-name"
                                        class="form-control" value="John Doe">
                                </div>
                                <div class="form-group">
                                    <label for="side-profile-email">Email</label>
                                    <input type="email" id="side-profile-email" name="side-profile-email"
                                        class="form-control" value="john.doe@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="side-profile-password">New Password</label>
                                    <input type="password" id="side-profile-password" name="side-profile-password"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="side-profile-password-confirm">Confirm New Password</label>
                                    <input type="password" id="side-profile-password-confirm"
                                        name="side-profile-password-confirm" class="form-control">
                                </div>
                                <div class="form-group remove-margin">
                                    <button type="submit" class="btn btn-effect-ripple btn-primary"
                                        onclick="App.sidebar('close-sidebar-alt');">Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- END Profile -->

                        <!-- Settings -->
                        <div class="sidebar-section">
                            <h2 class="text-light">Settings</h2>
                            <form action="index.html" method="post" class="form-horizontal form-control-borderless"
                                onsubmit="return false;">
                                <div class="form-group">
                                    <label class="col-xs-7 control-label-fixed">Notifications</label>
                                    <div class="col-xs-5">
                                        <label class="switch switch-success"><input type="checkbox"
                                                checked><span></span></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-7 control-label-fixed">Public Profile</label>
                                    <div class="col-xs-5">
                                        <label class="switch switch-success"><input type="checkbox"
                                                checked><span></span></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-7 control-label-fixed">Enable API</label>
                                    <div class="col-xs-5">
                                        <label class="switch switch-success"><input
                                                type="checkbox"><span></span></label>
                                    </div>
                                </div>
                                <div class="form-group remove-margin">
                                    <button type="submit" class="btn btn-effect-ripple btn-primary"
                                        onclick="App.sidebar('close-sidebar-alt');">Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- END Settings -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Alternative Sidebar -->

            <!-- Main Sidebar -->
            <div id="sidebar">
                <!-- Sidebar Brand -->
                <div id="sidebar-brand" class="" style="background-color:white">
                    <a href="{{Url('dashboard') }}" class="sidebar-title">
                        <img src="{{Url('public/img/logo.png')}}">
                    </a>
                </div>
                <!-- END Sidebar Brand -->

                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Sidebar Navigation -->
                        <ul class="sidebar-nav">
                            <li>
                                <a href="{{Url('dashboard') }}"
                                    class="{{ Request::is('dashboard') ? 'active' : '' }}"><i
                                        class="gi gi-compass sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Dashboard</span></a>
                            </li>
                            {{-- <li>
                                <a href="{{Url('sections') }}"
                                    class="{{ (Request::is('sections') || Request::is('add-section') || Request::is('edit-section/*')) ? 'active' : '' }}"><i
                                        class="fa fa-list sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Sections</span></a>
                            </li> --}}
                            <li>
                                <a href="{{Url('level') }}"
                                    class="{{ (Request::is('level') || Request::is('add-level') || Request::is('edit-level/*')) ? 'active' : '' }}"><i
                                        class="fa fa-level-up sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Question Level</span></a>
                            </li>
                            <li>
                                <a href="{{Url('questions') }}"
                                    class="{{ (Request::is('questions') || Request::is('add-question') || Request::is('edit-question/*')) ? 'active' : '' }}"><i
                                        class="fa fa-question-circle sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Questions</span></a>
                            </li>
                            <li>
                                <a href="{{Url('campus-reports') }}"
                                    class="{{ (Request::is('campus-reports') || Request::is('user-reports/*') || Request::is('user-view/*')) ? 'active' : '' }}"><i
                                        class="fa fa-flag-checkered sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Reports</span></a>
                            </li>
                            {{-- <li>
                                <a href="{{Url('users') }}" class="{{ Request::is('users') ? 'active' : '' }}"><i
                                        class="gi gi-inbox sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Users</span></a>
                            </li> --}}
                            <li>
                                <a href="{{Url('colleges') }}"
                                    class="{{ (Request::is('colleges') || Request::is('add-college') || Request::is('edit-college/*')) ? 'active' : '' }}"><i
                                        class="fa fa-university sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Company</span></a>
                            </li>
                            <li>
                                <a href="{{Url('campuses') }}"
                                    class="{{ (Request::is('campuses') || Request::is('add-campus') || Request::is('edit-campus/*')) ? 'active' : '' }}"><i
                                        class="fa fa-book sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Assessments</span></a>
                            </li>
                            <li>
                                <a href="{{Url('predefined-questions') }}"
                                    class="{{ (Request::is('predefined-questions') || Request::is('add-prequestions') || Request::is('edit-prequestions/*')) ? 'active' : '' }}"><i
                                        class="fa fa-get-pocket sidebar-nav-icon"></i><span
                                        class="sidebar-nav-mini-hide">Group Questions</span></a>
                            </li>
                        </ul>
                        <!-- END Sidebar Navigation -->

                        <!-- Color Themes -->
                        <!-- Preview a theme on a page functionality can be found in js/app.js - colorThemePreview() -->
                        {{-- <div class="sidebar-section sidebar-nav-mini-hide">
                            <div class="sidebar-separator push">
                                <i class="fa fa-ellipsis-h"></i>
                            </div>
                            <ul class="sidebar-themes clearfix">
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-default" data-toggle="tooltip"
                                        title="Default" data-theme="default" data-theme-navbar="navbar-inverse"
                                        data-theme-sidebar="">
                                        <span class="section-side themed-background-dark-default"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip"
                                        title="Classy" data-theme="css/themes/classy.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                                        <span class="section-side themed-background-dark-classy"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip"
                                        title="Social" data-theme="css/themes/social.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                                        <span class="section-side themed-background-dark-social"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip"
                                        title="Flat" data-theme="css/themes/flat.css" data-theme-navbar="navbar-inverse"
                                        data-theme-sidebar="">
                                        <span class="section-side themed-background-dark-flat"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-amethyst"
                                        data-toggle="tooltip" title="Amethyst" data-theme="css/themes/amethyst.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                                        <span class="section-side themed-background-dark-amethyst"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip"
                                        title="Creme" data-theme="css/themes/creme.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                                        <span class="section-side themed-background-dark-creme"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip"
                                        title="Passion" data-theme="css/themes/passion.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                                        <span class="section-side themed-background-dark-passion"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-default" data-toggle="tooltip"
                                        title="Default + Light Sidebar" data-theme="default"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip"
                                        title="Classy + Light Sidebar" data-theme="css/themes/classy.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip"
                                        title="Social + Light Sidebar" data-theme="css/themes/social.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip"
                                        title="Flat + Light Sidebar" data-theme="css/themes/flat.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-amethyst"
                                        data-toggle="tooltip" title="Amethyst + Light Sidebar"
                                        data-theme="css/themes/amethyst.css" data-theme-navbar="navbar-inverse"
                                        data-theme-sidebar="sidebar-light">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip"
                                        title="Creme + Light Sidebar" data-theme="css/themes/creme.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip"
                                        title="Passion + Light Sidebar" data-theme="css/themes/passion.css"
                                        data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                                        <span class="section-side"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-default" data-toggle="tooltip"
                                        title="Default + Light Header" data-theme="default"
                                        data-theme-navbar="navbar-default" data-theme-sidebar="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-default"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip"
                                        title="Classy + Light Header" data-theme="css/themes/classy.css"
                                        data-theme-navbar="navbar-default" data-theme-sidebar="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-classy"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip"
                                        title="Social + Light Header" data-theme="css/themes/social.css"
                                        data-theme-navbar="navbar-default" data-theme-sidebar="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-social"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip"
                                        title="Flat + Light Header" data-theme="css/themes/flat.css"
                                        data-theme-navbar="navbar-default" data-theme-sidebar="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-flat"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-amethyst"
                                        data-toggle="tooltip" title="Amethyst + Light Header"
                                        data-theme="css/themes/amethyst.css" data-theme-navbar="navbar-default"
                                        data-theme-sidebar="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-amethyst"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip"
                                        title="Creme + Light Header" data-theme="css/themes/creme.css"
                                        data-theme-navbar="navbar-default" data-theme-sidebar="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-creme"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip"
                                        title="Passion + Light Header" data-theme="css/themes/passion.css"
                                        data-theme-navbar="navbar-default" data-theme-sidebar="">
                                        <span class="section-header"></span>
                                        <span class="section-side themed-background-dark-passion"></span>
                                        <span class="section-content"></span>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                        <!-- END Color Themes -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Main Sidebar -->

            <div id="main-container" style="background-color:#EBEDF1;">
                <header class="navbar navbar-inverse navbar-fixed-top"
                    style="background-color:white;border-bottom:3px solid #EBEDF1;">
                    <!-- Left Header Navigation -->
                    <ul class="nav navbar-nav-custom">
                        <!-- Main Sidebar Toggle Button -->
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                <i style="color:gray" class="fa fa-ellipsis-v fa-fw animation-fadeInRight"
                                    id="sidebar-toggle-mini"></i>
                                <i style="color:gray" class="fa fa-bars fa-fw animation-fadeInRight"
                                    id="sidebar-toggle-full"></i>
                            </a>
                        </li>
                        <!-- END Main Sidebar Toggle Button -->

                        <!-- Header Link -->
                        <li class="hidden-xs animation-fadeInQuick">
                            <a href=""><strong style="color:gray">WELCOME</strong></a>
                        </li>
                        <!-- END Header Link -->
                    </ul>
                    <!-- END Left Header Navigation -->

                    <!-- Right Header Navigation -->
                    <ul class="nav navbar-nav-custom pull-right">
                        <!-- User Dropdown -->
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{Url('public/img/placeholders/avatars/avatar9.jpg')}}">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-header">
                                    <strong>ADMINISTRATOR</strong>
                                </li>
                                <li>
                                    <!--<a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                                            <i class="gi gi-settings fa-fw pull-right"></i>
                                            Settings
                                        </a>-->
                                </li>
                                <li>
                                    <a href="{{Url('logout')}}">
                                        <i class="fa fa-power-off fa-fw pull-right"></i>
                                        Log out
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END User Dropdown -->
                    </ul>
                    <!-- END Right Header Navigation -->
                </header>
                <!-- <div id="page-content"> -->
                <!-- @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info')}}">{{ Session::get('message') }}</p>
                    @endif -->
                <div class="" style="padding-top:20px;">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->



    <script src="{{Url('public/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{Url('public/js/plugins.js')}}"></script>
    <script src="{{Url('public/js/app.js')}}"></script>
    <script src="{{Url('public/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{Url('public/js/dataTables.responsive.min.js')}}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
</body>

</html>