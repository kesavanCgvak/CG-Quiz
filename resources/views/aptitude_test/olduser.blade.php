@extends('layouts.app_home')
@section('content')
<style media="screen">
  body{
    background-image: url('./public/img/keyboard.jpg');
    background-size: cover;
  }
</style>
    <div class="main_page_content" id="main_page_content">
        <section class="satisfaction-form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="survey-questionnaire">
                            <div class="row">
                                <div class="col-sm-offset-2 col-md-8">
                                    <h2>Return With Previous Test <a href="{{ url('/apt-form/' . $campus_id) }}"><u>Click Here</u></a></h2>
                                    <h2>For New Test <a href="{{url('/newtest')}}"><u> Click Here</u></a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<script type="text/javascript">
history.pushState(null, null, location.href);
  window.onpopstate = function () {
      history.go(1);
  };
</script>
@endsection
