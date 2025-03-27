<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome to CG-VAK Quiz</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('public/login/images/icons/favicon.ico') }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/login/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome & Material Design Icons -->
    <link rel="stylesheet" href="{{ asset('public/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/fonts/iconic/css/material-design-iconic-font.min.css') }}">

    <!-- Animation & UI Styles -->
    <link rel="stylesheet" href="{{ asset('public/login/vendor/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/vendor/daterangepicker/daterangepicker.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('public/login/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/css/main.css') }}">
</head>

<body>
    <?php
//echo '<pre>';print_r($_COOKIE);die;
        ?>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form id="form-login" action="{{ url('login')}}" method="post" class="login100-form validate-form">
                    {{ csrf_field() }} <span class="login100-form-logo">
                        <img src="{{ url('public/login/images/logo.png')}}" alt="">
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        Log in
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="text" name="login_username" placeholder="Username"
                            value="{{ isset($_COOKIE['rem_username']) ? $_COOKIE['rem_username'] : old('email')}}">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        @if ($errors->has('login_username'))
                            <span class="help-block login_error_div">
                                <strong>{{ $errors->first('login_username') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" id="login_password" name="login_password"
                            placeholder="Password"
                            value="{{ isset($_COOKIE['rem_password']) ? $_COOKIE['rem_password'] : ''}}">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        <!-- @if ($errors->has('login_password'))
                                    <span class="help-block login_error_div">
                                        <strong>{{ $errors->first('login_password') }}</strong>
                                    </span>
                                @endif -->
                        @if ($errors)
                            <span class="help-block login_error_div">
                                <strong>{{$errors->first()}}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="rememberme" <?php if (isset($_COOKIE['rem_username'])) {
    echo 'checked="checked"';
} else {
    echo '';
} ?>>
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-90">
                        <!-- <a class="txt1" href="{{ url('forgot-pwd')}}">
                                Forgot Password?
                            </a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ url('public/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('public/login/vendor/animsition/js/animsition.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('public/login/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{ url('public/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('public/login/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('public/login/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ url('public/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('public/login/vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('public/login/js/main.js')}}"></script>

</body>

</html>