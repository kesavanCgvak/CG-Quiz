@extends('layouts.app_home')
@section('content')
<style>
.form-group {
    border-bottom:0px;
    margin-bottom:15px;
    padding:0px;
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
                                <h1>Change Password</h1>
                                <hr>
                                <form id="forgot_pwd_form" action="{{ url('change-pwd') }}" method="POST">
                                <div class="form-group">
                                <label for="email">Current Password</label>
                                <input type="password" name="current_pwd"  class="form-control" placeholder="Enter Current Password">
                                </div>
                                <div class="form-group">
                                <label for="email">New Password</label>
                                <input type="password" name="new_pwd"  class="form-control" placeholder="Enter New Password">
                                </div>
                                <div class="form-group">
                                <label for="email">Confirm New Password</label>
                                <input type="password" name="cnf_pwd"  class="form-control" placeholder="Confirm new Password">
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