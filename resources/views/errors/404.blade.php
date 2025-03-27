
<!DOCTYPE html>
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} :: 404 </title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <link rel="shortcut icon" href="{{ Url('public/img/favicon.png') }}">
 <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ Url('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ Url('public/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ Url('public/css/main.css') }}">
    <link rel="stylesheet" href="{{ Url('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ Url('public/css/themes.css') }}">
    <link rel="stylesheet" href="{{ Url('public/css/responsive.bootstrap.min.css') }}">
    <!-- Modernizr (browser feature detection library) -->
    <script src="{{ Url('public/js/vendor/modernizr-3.3.1.min.js') }}"></script>
    <script src="{{ Url('public/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ Url('public/js/vendor/jquery.validate.js') }}"></script>


    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{Url('public/css/plugins.css')}}">
    <link rel="stylesheet" href="{{Url('public/css/style.css')}}">
    <script src="{{ Url('public/js/vendor/modernizr-3.3.1.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('public/form/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" href="">

<style>
body{
  background-color:#3AB3C3;
}
h1{
  opacity:0.3;
  color:white;
  font-size: 200px;
  font-family:Andale Mono, monospace;
  margin-top: 10px;
}
h3{
  color:white;
  font-size: 50px;
  font-weight:bold;
  padding-bottom:20px;
}
.container{
  text-align: center;
  padding:10px;
  width:50%;
  border:1px solid white;
  border-radius:25px;
  margin-top:100px;
  padding:50px;
}
a{
  border:2px solid white;
  border-radius: 10px;
  padding:15px;
  color:white;
  text-decoration: none;
  font-weight: bold;
}
</style>

</head>

<body>

    <div id="page-wrapper" class="page-loading">
        <div class="preloader">
            <div class="inner">
                <div class="preloader-spinner themed-background hidden-lt-ie10"></div>
                <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
            </div>
        </div>
<!--        <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
            <div id="sidebar">
                <div id="sidebar-brand" class="themed-background">
                    <a class="sidebar-title">
                        <img src="{{ Url('public/img/logo.png') }}" >
                    </a>
                </div>
            </div>
        </div>-->
            <div id="main-container">
                @include('common.header')
                <div class="container">
                <h1>404</h1>
                <h3>Page Not Found</h3>
                <a href={{ 'quiz/' }}><span>Go To Home Page</span></a>
                </div>
            </div>

    </div>

        <script src="{{ Url('public/js/vendor/bootstrap.min.js') }}"></script>

        <script src="{{ Url('public/js/plugins.js') }}"></script>
        <script src="{{ Url('public/js/app.js') }}"></script>
        <script src="{{ Url('public/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ Url('public/js/dataTables.responsive.min.js') }}"></script>


<!--
    <script src="{{ Url('public/js/dragtable.js') }}"></script>
    <script src="{{ Url('public/js/plugins.js') }}"></script>
    <script src="{{ Url('public/js/readyDashboard.js') }}"></script>
    <script src="{{ Url('public/js/formsComponents.js') }}"></script>
    <script src="{{ Url('public/js/callapi.js') }}"></script>
    <script src="{{ Url('public/js/uiTables.js') }}"></script>
    <script src="{{ Url('public/js/readyLogin.js') }}"></script>
    <script src="{{ Url('public/js/custom.js') }}"></script> -->
</body>
</html>
