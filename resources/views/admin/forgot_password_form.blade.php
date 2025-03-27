@extends('layouts.app_home')
@section('content')
<style>
.form-group {
    border-bottom:0px;
}
ul li{
    list-style:none;
}
</style>

<div id="page-content">
    <div class="main_page_content" id="main_page_content">
        <section class="satisfaction-form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="survey-questionnaire">
                            <div class="row">
                                <div class="col-sm-offset-2 col-md-8">
                                @if($errors->any())
                                <div class="alert alert-danger">
                                <ul>
                                @foreach($errors->all() as $error)
                                <li>
                                {{$error}}
                                </li>
                                @endforeach
                                
                                </ul>

                                </div>
                                @endif

                                @if(Session::has('message'))
                                <div class="alert alert-info">
                                <p style="text-align:center;">{{ Session::get('message')}}</p>
                                </div>
                                @endif
                                <form id="forgot_pwd_form" action="{{ url('forgot-pwd') }}" method="POST">
                                <div class="form-group">
                                <label for="email">Enter Your Account Email ID</label>
                                <input type="text" name="email" value="{{ old('email')}}" class="form-control">
                                </div>                                                                       
                                    <h3>       
                                        <a href="#" onclick="document.getElementById('forgot_pwd_form').submit()">
                                            Submit
                                        </a>								
                                         
                                            {{ csrf_field() }}
                                       
                                    </h3>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>    
@endsection