@extends('layouts.app_home')
@section('content')
  <style media="screen">
    body{
      background-image: url('../public/img/bg8.jpg');
      background-repeat: no-repeat;
      background-size: cover;
    }
    .message{
      margin-top:10%;
      left:40%;
      /* border:2px solid white; */
      /* border-radius: 3px; */
      /* padding:10px; */
    }
    .message li{
      padding: 15px 0 30px 20px;
      font-weight:bold;
      list-style-type: none;
      color:black;
      font-size: 20px;
    }
    .message li:before {
      font-family: 'FontAwesome';
      content: '\f0a4';
      padding:6px;
      border-radius: 13px;
      margin:0 25px 0 -15px;
      color: black;
    }
    /* .list{
      background-color: green;
      margin-bottom:15px;
    } */
  </style>
{{-- <div id="page-content"> --}}
    {{-- <div class="main_page_content" id="main_page_content"> --}}
        <section class="satisfaction-form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="survey-questionnaire">
                            <div class="row">
                                <div class="col-md-8 message">
                                    {{-- <h2 class="common-primary-head">You have successfully completed the Quiz <br> Thank you</h2>                                 --}}
                                    <h4><ul>

                                      <div class="list"><li>This concludes your Quiz.</li></div>
                                      <div class="list"><li>Please collect all your belongings.</li></div>
                                      <div class="list"><li>You must return all work paper and materials to the Test Coordinator.</li></div>
                                      <div class="list"><li>Thank you for completing the Quiz.</li></div>
                                      <div class="list"><li>Good Luck for your Test Results!</li></div>
                                    </ul></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    {{-- </div> --}}
{{-- </div> --}}
<script type="text/javascript">
history.pushState(null, null, location.href);
  window.onpopstate = function () {
      history.go(1);
  };

  $(document).ready(function() {
    // alert();
        localStorage.removeItem('elasped_time');            
     });
</script>

<script>setTimeout(function(){window.location.href="{{ route('/')}}"},1*30*1000);</script>
@endsection
