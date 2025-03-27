<!DOCTYPE html>
<html lang="en">

    <head>
        <title>.:: Welcome to CG-VAK Job Satisfaction Survey ::.</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="{{ url('public/login/images/icons/favicon.ico')}}"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/vendor/bootstrap/css/bootstrap.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/vendor/animate/animate.css')}}">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/vendor/css-hamburgers/hamburgers.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/vendor/animsition/css/animsition.min.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/vendor/select2/select2.min.css')}}">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/vendor/daterangepicker/daterangepicker.css')}}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/css/util.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ url('public/login/css/main.css')}}">
        <!--===============================================================================================-->
    </head>
    <body>

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <form id="form-login" action="{{ route('login') }}" method="post" class="login100-form validate-form">
                        {{ csrf_field() }}
                        <span class="login100-form-logo">
                            <img src="{{ url('public/login/images/logo.png')}}" alt="">
                        </span>

                        <span class="login100-form-title p-b-34 p-t-27">
                            Log in
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input class="input100" type="text" name="login_username" placeholder="Username" value="{{ old('email') }}">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                            @if ($errors->has('login_username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login_username') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" id="login_password" name="login_password" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                             @if ($errors->has('login_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login_password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
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
                            <a class="txt1" href="#">
                                Forgot Password?
                            </a>
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
