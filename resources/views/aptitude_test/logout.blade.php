@extends('layouts.app_home')
@section('content')
<style media="screen">
  body{
    background-image: url('./public/img/keyboard.jpg');
    background-size: cover;
  }
</style>
{{-- <div id="page-content"> --}}
    <div class="main_page_content" id="main_page_content">
        <section class="satisfaction-form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="survey-questionnaire">
                            <div class="row">
                                <div class="col-sm-offset-2 col-md-8">
                                    <h1 class="common-primary-head">Loggedout Successfully</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
{{-- </div> --}}
<script type="text/javascript">
history.pushState(null, null, location.href);
  window.onpopstate = function () {
      history.go(1);
  };
</script>
<script>setTimeout(function(){window.location.href="{{ route('/')}}"},1*30*1000);</script>
@endsection
