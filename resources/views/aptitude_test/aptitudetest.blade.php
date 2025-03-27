@extends('layouts.app_home')
@section('content')
<style media="screen">
/* .nav{
  display:none;
} */
header{
  display: none;
}
  body{
    background-image: url('public/img/bg24.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    min-height:100vh;
  }
  .alert{
    background-color: #de5c5c;
  }
  .logo{
    width:50%;
  }
  .logo-div{
    margin-left: 35%;
  }
  #main_page_content{
  max-width: 700px;
  padding: 120px 0px;
  color:white;
  }
  .form{
    border-radius: 5px;
    color:white;
  }
  .form-group{
    border-bottom: none;
  }
  .control-label{
    margin-left:10px;
  }
  input{
    max-width:50%;
    padding:5px;
    border-style: none;
    border: 2px solid white ;
    border-radius: 5px;
    background: transparent;
    opacity:0.8;
    color:white;
  }
</style>

<div class=" container">
  @if($errors->any())
  <div class="alert">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
    <div class="col-xs-12 main_page" id="main_page_content">
        <div class="logo-div">
          <img src="public/img/logo.png" class="logo" alt="logo">
        </div>
        <h1 class="text-center"> Welcome To CG-VAK Quiz </h1>
        <h3 class="text-center">Please Enter the Password and Continue</h3>
        <div class="col-xs-12 form">
          <form class="" action="{{ url('enter') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <div class="text-center">
                <input class="password" type="password" name="test_password" value=""><br><br>
                <button type="submit" class="btn btn-effect-ripple btn-primary">Enter</button>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection
