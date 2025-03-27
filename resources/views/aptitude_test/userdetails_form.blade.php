@extends('layouts.app_home')
@section('content')
<style>
.college {
 font-size: 20px;
 color:white;
}
.common-primary-head {
    text-align: center;
    margin: 25px 0px 40px 0px;
    color: white;
    border-bottom: 2px solid gray;
    border-bottom-width:thin;
    padding-bottom: 15px;
}
.main_page_content{
  margin-top: 50px;
}
.container{
  /* border :2px solid white; */
  /* width:60%; */
  margin-top:10px;
  border-radius: 6px;
}
body{
  background-image: url('../public/img/bg4.jpg') !important;
  padding: 50px;
  background-size: cover;
  background-repeat: no-repeat;
}

ul{
    line-height:40px;
}

li{
    list-style:none;
}

form {
  margin: 20px auto;
  text-align: center;
}
label {
  display: block;
  position: relative;
  margin: 40px 0px;
}
input {/* #page-content{
  background-image: url('public/img/lock.jpg');
  background-size: cover;
} */
  width: 100%;
  padding: 10px;
  background: transparent;
  border: none;
  outline: none;
  color:white;
}

.line-box {
  position: relative;
  width: 100%;
  height: 2px;
  background: #BCBCBC;
}

.line {
  position: absolute;
  width: 0%;
  height: 2px;
  top: 0px;
  left: 50%;
  transform: translateX(-50%);
  background: #8BC34A;
  transition: ease .6s;
}

input:focus + .line-box .line {
  width: 100%;
}

.label-txt {
  position: absolute;
  top: -1.6em;
  padding: 10px;
  font-family: sans-serif;
  font-size: .8em;
  letter-spacing: 1px;
  transition: ease .3s;
  color:white;
}

.label-active {
  top: -3em;
}
.red{
    color:red;
}
#mybtn{
    background-color: #027dc4;
    border-color: #027dc4;
    color: #ffffff !important;
    display: block;
    width: 255px;
    margin: 10px auto !important;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>

<div class="container">
<div class="main_page_content" id="main_page_content">
      <div class="col-sm-12 text-center">
        <span class="college"><h3>WELCOME &nbsp; <b>{{ $College }}</b>&nbsp;STUDENTS</h3></span>
      </div>
      <div class="col-sm-offset-2 col-md-8">
          <h2 class="common-primary-head">Fill Your Details</h2>
          <form method="post" action="{{ url('/saveuser',base64_encode($campus->campus_id))}}">
          {{ csrf_field() }}
          @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
            <label>
                <p class="label-txt">ENTER YOUR NAME<span class='red'>*</span></p>
                <input type="text" class="input" name="name" autocomplete="off" value="{{ old('name') }}">
                <!-- pattern="^[a-zA-Z0-9]+$" -->
                <div class="line-box">
                <div class="line"></div>
                </div>
            </label>
            <label>
                <p class="label-txt">ENTER YOUR EMAIL<span class='red'>*</span></p>
                <input type="text" class="input" name="email" autocomplete="off" value="{{ old('email') }}">
                <div class="line-box">
                <div class="line"></div>
                </div>
            </label>
            <label>
                <p class="label-txt">ENTER YOUR REG NUMBER<span class='red'>*</span></p>
                <input type="text" class="input" name="registration_number" autocomplete="off" value="{{ old('registration_number') }}">
                <div class="line-box">
                <div class="line"></div>
                </div>
            </label>
            <input type="hidden" name="campus_id" value="{{$campus->campus_id}}">
            <h3>
            <input type="submit" value="Submit and Start the Test" id="mybtn">
            </h3>
            </form>
      </div>
    </div>
  </div>

<script>
$(document).ready(function(){

$('input').focus(function(){
  $(this).parent().find(".label-txt").addClass('label-active');
});

$("input").focusout(function(){
  if ($(this).val() == '') {
    $(this).parent().find(".label-txt").removeClass('label-active');
  };
});

});
</script>

@endsection
