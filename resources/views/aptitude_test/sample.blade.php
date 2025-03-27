@extends('layouts.app_home')
@section('content')
<script type="text/javascript">
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<div id="page-content">
    <div class="main_page_content" id="main_page_content">
        <section class="satisfaction-form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="survey-questionnaire">
                            <div class="block">
                                <!-- Progress Bars Wizard Title -->
                                <div class="block-title ">
                                    <h2>Quiz</h2>
                                    <h1 class="pull-right"><span id="timerText"></span></h1>
                                </div>

                                <form id="progress-wizard" action="{{url('save-answers',base64_encode($campus->campus_id))}}"  method="post" name="add_command" class="form-horizontal form-bordered">
                                    {{ csrf_field() }}
                                    <!-- END Progress Bar -->
                                    @php
                                    $i = 1;
                                    $j = 1;

                                    @endphp
                                    <?php

                                    // $division = 3;
                                    // $count = $campus->question_count;
                                    // //echo $count;
                                    // //echo "<br>";
                                    // $quotient = floor($count/$division);
                                    // //echo $quotient;
                                    // //echo "<br>";
                                    // $reminder = $count%$division;
                                    // //echo $reminder;
                                    // //echo "<br>";
                                    // $secondstart = $quotient+1;
                                    // //echo $secondstart;
                                    // //echo "<br>";
                                    // $secondend  = $quotient+$quotient;
                                    // //echo $secondend;
                                    // //echo "<br>";
                                    // $thirdstart = $quotient+$quotient+1;
                                    // //echo $thirdstart;
                                    // //echo "<br>";
                                    // //exit;
                                    ?>
                                    @foreach ($questions as $question)

                                    {{-- @foreach($sections as $section) --}}
                                    {{-- <label style="color:gray;" for="">{{$question->section_name}}</label> --}}
                                   @php
                                   if ($i == 1) {
                                       echo '<div id="progress-first" class="step">';
                                    } else if ($i == $secondstart) {
                                       echo '<div id="progress-second" class="step">';
                                    } else if ($i == $thirdstart) {
                                        echo '<div id="progress-third" class="step">';
                                   }
                                    @endphp
                                    {{-- <h2>{{$question->section_id}}</h2> --}}
                                    <div class="form-group">
                                        {{-- <label style="color:gray;" for=""> {{$question->section_name}} </label> --}}
                                        <label class="question apt_questions">{{ $i }}. {{ $question->question_name }}</label>
                                        <?php $cl = 'A'; ?>
                                        @foreach ($question->options as $option)
                                        <div class="radio">
                                            <input type="radio" class ="{{ $question->question_id }}" name="{{ $question->question_id }}" value="{{ $option->option_id }}" id="{{ $question->question_id }}{{ $option->option_id }}">
                                            <label for="{{ $question->question_id }}{{ $option->option_id }}"> <b> {{ $cl.') '.$option->option_value }}</b></label>
                                        </div>
                                        <?php $cl++; ?>
                                        @endforeach
                                        <span class="{{ $question->question_id }}-error"></span>
                                    </div>
                                     <?php
                                    // if ($i == $quotient) {
                                    //     echo '</div>';
                                    // } else if ($i == $secondend) {
                                    //     echo '</div>';
                                    // } else if ($i == $count){
                                    //     echo '</div>';
                                    // }
                                    ?>

                                    {{-- @php
                                    $i++;

                                    @endphp --}}

                                    {{-- @endforeach --}}
                                    @endforeach
                                    {{-- @php
                                    // echo $i;
                                    //  exit;
                                     @endphp --}}
                                    <div class="">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="button" class="btn btn-effect-ripple btn-danger" onclick="backbuttonf(this);" id="back" style="display:none;">Back</button>
                                            <button type="button" class="btn btn-effect-ripple btn-primary button_wizad_contanat_change"  id="next" onclick="nextbuttonf(this); ">Next</button>
                                            <input type="button" class="btn btn-effect-ripple btn-primary button_wizad_contanat_changes" id="next2" style="display:none;" onClick="isOneChecked(this.form);" value="Submit">
                                        </div>
                                        <div id="commonerrorid" style="display: none;color:red; padding-left: 357px; padding-top: 43px;"><b>Please answer all questions</b></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style type="text/css">
    #progress-first{display: block;}
    #progress-second{display: none;}
    #progress-third{display: none;}
</style>

<script type="text/javascript">
 var seconds =  "<?php echo $campus->min_val; ?>";
function timer() {
  var days        = Math.floor(seconds/24/60/60);
  var hoursLeft   = Math.floor((seconds) - (days*86400));
  var hours       = Math.floor(hoursLeft/3600);
  var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
  var minutes     = Math.floor(minutesLeft/60);
  var remainingSeconds = seconds % 60;
  function pad(n) {
    return (n < 10 ? "0" + n : n);
  }
  document.getElementById('timerText').innerHTML = pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
  if(seconds < 60){
    document.getElementById("timerText").style.color = "red";
  }
  if (seconds == 0) {
    // document.getElementById('progress-wizard').submit();
    var options = parseInt($('input:radio:checked').length);
    var questions =  parseInt($('.apt_questions').length);
    var ans = questions - options;
    // alert("Unanswered questions = " + ans);
    clearInterval(countdownTimer);
    // document.getElementById('timerText').innerHTML = "Completed";
  }
  else {
    seconds--;
  }
}
var countdownTimer = setInterval('timer()', 1000);
function nextbuttonf(msg) {
//        alert($("#progress-wizard").valid());

    if ($("#progress-wizard").valid() == false){
        return false;
    }

    var idcheck = $(msg).attr("id");
    if (idcheck == "next"){
    $("#next").attr('id', 'next2');
    $("#back").attr('id', 'back2');
    $("#progress-first").css("display", "none");
    $("#progress-second").css("display", "block");
    $("#progress-third").css("display", "none");
    $("#back2").css("display", "inline-block");
    }

    if (idcheck == "next2"){
    $(".button_wizad_contanat_change").css("display", "none");
    $(".button_wizad_contanat_changes").css("display", "inline-block");
    $("#next2").attr('id', 'next3');
    $("#back2").attr('id', 'back3');

    $("#progress-first").css("display", "none");
    $("#progress-second").css("display", "none");
    $("#progress-third").css("display", "block");
    }
    window.scrollTo(0,0);
    };

    function backbuttonf(msg) {
    // alert($("#progress-wizard").valid());
    var idcheck = $(msg).attr("id");
    if (idcheck == "back2"){
    $("#next2").attr('id', 'next');
    $("#progress-first").css("display", "block");
    $("#progress-second").css("display", "none");
    $("#progress-third").css("display", "none");
    $("#back2").css("display", "none");

    }
    if (idcheck == "back3"){
    $("#next3").attr('id', 'next2');
    $("#back3").attr('id', 'back2');
    $("#progress-first").css("display", "none");
    $("#progress-second").css("display", "block");
    $("#progress-third").css("display", "none");
    $(".button_wizad_contanat_change").css("display", "inline-block");
    $(".button_wizad_contanat_changes").css("display", "none");

    }
    window.scrollTo(0,0);
    };

function isOneChecked(form) {
  // All <input> tags...
  var chx = document.getElementsByTagName('input');

    if($('input:radio:checked').length > 0){
        var options = parseInt($('input:radio:checked').length);
        var questions =  parseInt($('.apt_questions').length);
        var ans = questions - options;
        var answer =  confirm("Unanswered questions = " + ans);
        if (answer == true) {
        form.submit();
        }
      }
        else {
          alert('Please select an option or else please logout');
        }
  }
// }

$(document).bind('contextmenu', function (e) {
        e.preventDefault();
        // alert('Right Click is not allowed');
        return false;
});
$(document).keydown(function(e) {
        if (e.keyCode == 116 ) {
            // alert("Don't Refresh dude");
            return false;
        }
    });
$(document).keydown(function(e) {
        if (e.keyCode == 82 && e.ctrlKey) {
            // alert("Don't Refresh dude");
            return false;
        }
    });



//     (function ($, W, D)
//     {
//     var JQUERY4U = {};
//     JQUERY4U.UTIL =
//     {
//       setupFormValidation: function ()
//       {
//       //form validation rules
//         $("#progress-wizard").validate({
//               rules: {
//               @foreach ($questions as $question)
//                 {{ $question->question_id }}:{required: true},
//               @endforeach
//               },
//               messages: {
//               @foreach ($questions as $question)
//               {{ $question->question_id }}: "Please choose an option !",
//               @endforeach
//               },
//               errorPlacement: function(error, element){
//                 console.log(element);
//                 var classname = element.parents(".form-group").find("span").attr('class');
//                 console.log(classname);
//                 $('.' + classname).html(error);
//               },
//               submitHandler: function (form) {
//                 form.submit();
//               }
//         });
//       }
//     }
//     //when the dom has loaded setup form validation rules
//     $(D).ready(function ($) {
//       JQUERY4U.UTIL.setupFormValidation();
//     });
//     })(jQuery, window, document);
// $('.radio').click('on',function(e) {
//         e.preventDefault();
//         $(this).children().find('b').css('color','green');
//  });
// .form-group .radio label
</script>
@endsection
