@extends('layouts.app_home')
@section('content')
    <style>
        body {
            background-image: url('../public/img/bg11.jpg');
            background-size: 100%;
            background-repeat: no-repeat;
        }

        .common-primary-head {
            text-align: center;
            margin: 15px 0px 40px 0px;
            color: black;
            border-bottom: 2px solid #6cd2e1;
            border-width: thin;
            padding-bottom: 15px;
        }

        .text-center {
            margin-top: 40px;
        }

        .college {
            text-align: center;
            font-size: 20px;
            color: black;
        }

        ul {
            line-height: 40px;
            /* color:white; */
        }

        li {
            font-size: 16px;
        }
    </style>

    <div class="container-fluid">
        <div class="col-sm-12 text-center">
            <span class="college"><h3>WELCOME  &nbsp;<b>{{ $College }}</b> &nbsp;STUDENTS</h3></span>
        </div>
        <div class="survey-questionnaire">
            <div class="col-sm-offset-2 col-md-8">
                <h2 class="common-primary-head">General Instructions</h2>
                <ul>
                    <li>Please read the following carefully before making an attempt to take the Test</li>
                    <li>Do not keep with you books, calculators (including watch calculators), cellular phones, or any
                        other device.
                    </li>
                    <li>Select the appropriate option against each question <br>
                    </li>
                    <li>On completion of the test, you are required to click submit button.</li>

                </ul>

                <h3>
                    <a href="{{ url('user-details',base64_encode($campus->campus_id))}}">
                        Click here to register
                    </a>
                </h3>
            </div>
        </div>
    </div>

    <script type="text/javascript">
         $(document).ready(function() {
        localStorage.removeItem('elasped_time');            
        });
    </script>
@endsection
