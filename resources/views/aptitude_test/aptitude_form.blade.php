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
                            {{-- <span class="college">WELCOME <b>{{ $College }}</b></span> --}}
                            <div class="survey-questionnaire">
                                <div class="block">
                                    <!-- Progress Bars Wizard Title -->
                                    <div class="block-title ">
                                        <h2>Quiz</h2>
                                    <h1 class="pull-right"><span class="timer" >TIME REMAINING: </span> &nbsp;<span
                                                    id="timerText" style="color:green"></span></h1>
                                    </div>

                                    <form id="progress-wizard"
                                          action="{{url('save-answers',base64_encode($campus->campus_id))}}"
                                          method="post" name="add_command" class="form-horizontal form-bordered">
                                    {{ csrf_field() }}
                                    <!-- END Progress Bar -->
                                        @php
                                            $i = 1;
                                            $j = 1;
                                            // $cl = 'A';
                                            $sum = 0;
                                        @endphp
                                        {{--Quiz Questions--}}
                                        <div class="" id="group">
                                            @foreach($sections as $section)
                                                <div class="step" id="progress-{{ $section->id }}">
                                                    <h3 class=""><b> {{ $section->section_name }}</b></h3>
                                                    @php
                                                        $new  = array();
														
														$questions[$section->id];
														
                                                        $keys = array_keys($questions[$section->id]);
                                                        shuffle($keys);
                                                        foreach ($keys as $key) {
                                                        $new[$key] = $questions[$section->id][$key];
                                                        //    print_r($questions[$section->id][$key]);
                                                        }
                                                        // print_r($new);
                                                    @endphp
                                                    @foreach ($new as $key => $question_value)
                                                        
                                                        @if(count($question_value) > 1)
                                                            @php                                                                    
                                                                $cl = 'A';
                                                            @endphp   
                                                            @foreach($question_value as $skey => $question)                                                                                                                    
                                                            <article class="">
                                                                @if(!empty($question->question_info))
                                                                    <label class="question">
                                                                            {{ $i }}. {!! $question->question_info !!}</label><br>
                                                                @endif            
                                                                <label class="question sub_ques apt_questions">{{ $cl }}
                                                                    . {!! $question->question_name !!}</label> 
                                                                @php                                                                    
                                                                    $cl++;
                                                                @endphp       
                                                                @foreach ($question->options as $option)
                                                                    <article class="radio">
                                                                        <input type="radio"
                                                                            class="radio-custom {{ $question->question_id }}"
                                                                            name="{{ $question->question_id }}"
                                                                            value="{{ $option->option_id }}"
                                                                            id="{{ $question->question_id }}{{ $option->option_id }}">
                                                                        <label class="radio-custom-label"
                                                                            for="{{ $question->question_id }}{{ $option->option_id }}">
                                                                            <b> {{ $option->option_value }}</b></label><br>
                                                                    </article>        
                                                                @endforeach
                                                                <br><br>
                                                                @endforeach
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                            </article>

                                                        @else
                                                        
                                                            @foreach($question_value as $skey => $question)                                                        
                                                            <article class="form-group">
                                                                    {{-- <label class="question">
                                                                        {{ $i }}. {!! $question->question_info !!}</label>                                                                                                                               --}}
                                                                <label class="question apt_questions">{{ $i }}
                                                                    . {!! $question->question_name !!}</label>            
                                                                @foreach ($question->options as $option)
                                                                    <article class="radio">
                                                                        <input type="radio"
                                                                            class="radio-custom {{ $question->question_id }}"
                                                                            name="{{ $question->question_id }}"
                                                                            value="{{ $option->option_id }}"
                                                                            id="{{ $question->question_id }}{{ $option->option_id }}">
                                                                        <label class="radio-custom-label"
                                                                            for="{{ $question->question_id }}{{ $option->option_id }}">
                                                                            <b> {{ $option->option_value }}</b></label><br>
                                                                    </article>
                                                                @endforeach                                                                
                                                                @php
                                                                    $i++;
                                                                @endphp
                                                                @endforeach                                                                
                                                            </article>
                                                        @endif
                                                        {{-- @endforeach --}}
                                                        <hr style="background-color:lightblue;height:1px;">
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="button" class="btn btn-effect-ripple btn-danger" id="back"
                                                        style="display:none;">Back
                                                </button>
                                                <button type="button"
                                                        class="btn btn-effect-ripple btn-primary button_wizad_contanat_change"
                                                        id="next">Next
                                                </button>
                                                <input type="button"
                                                       class="btn btn-effect-ripple btn-primary button_wizad_contanat_changes"
                                                       id="next2" style="display:none;"
                                                       onClick="isOneChecked(this.form);" value="Submit">
                                            </div>
                                            {{-- <div id="commonerrorid" style="display: none;color:red; padding-left: 357px; padding-top: 43px;"><b>Please answer all questions</b></div> --}}
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

        .radio-custom {
            opacity: 0;
            position: absolute;
        }
        td{
            padding:10px;
        }
        p{
            display:inline;
        }
        img{
            display: block;
        }
        .radio-custom + .radio-custom-label:before {
            content: '';
            /* background: gray; */
            border-radius: 50%;
            border: 2px solid gray;
            display: inline-block;
            vertical-align: middle;
            width: 20px;
            height: 20px;
            padding: 2px;
            margin-right: 10px;
            text-align: center;
            line-height: 13px;
            text-align: center;
            font-size: 12px;
        }

        /* .radio-custom-label {
            position: relative;
        } */
        .radio-custom:checked + .radio-custom-label:before {
            content: "\f00c";
            /* background-color: green; */
            font-family: 'FontAwesome';
            color: green;
            border: 2px solid green;
        }

        /* .radio-custom .radio-custom-label{
            width:20px;
            display: inline-block;
            vertical-align: middle;
            margin: 5px;
            cursor: pointer;
            } */
        #group div {
            display: none;
        }

        #group div.current {
            display: block;
            /* border: 1px solid red; */
        }
        .sub_ques{
            margin-left:10px;
        }
    </style>

    <script type="text/javascript">
        var seconds = "<?php echo $campus->min_val; ?>";
        if(localStorage.getItem('elasped_time') != ''  && localStorage.getItem('elasped_time')!= null && localStorage.getItem('elasped_time').toLowerCase() != 'undefined'){
           seconds = elasped_time(localStorage.getItem('elasped_time').toLowerCase());
           console.log("seconds =>",seconds)
        }
        function timer() {
            var days = Math.floor(seconds / 24 / 60 / 60);
            var hoursLeft = Math.floor((seconds) - (days * 86400));
            var hours = Math.floor(hoursLeft / 3600);
            var minutesLeft = Math.floor((hoursLeft) - (hours * 3600));
            var minutes = Math.floor(minutesLeft / 60);
            var remainingSeconds = seconds % 60;

            function pad(n) {
                return (n < 10 ? "0" + n : n);
            }

            var Time = pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);  
            document.getElementById('timerText').innerHTML = Time;
            if (seconds < 60) {
                document.getElementById("timerText").style.color = "red";
            }            
            if (seconds == 0) {
                document.getElementById('progress-wizard').submit();
                var options = parseInt($('input:radio:checked').length);
                var questions = parseInt($('.apt_questions').length);
                var ans = questions - options;
                // alert("Time is up"+ '\n' + "Unanswered questions = " + ans);
                alert("Time is up"+ '\n' + "Click OK to submit");
                clearInterval(countdownTimer);
                document.getElementById('timerText').innerHTML = "Completed";
            }
            else {
                seconds--;
            }
        }
        var countdownTimer = setInterval('timer()', 1000);

        // Changing Div

        function updateItems(delta) {
            var $items = $('#group').children();
            var $current = $items.filter('.current');
            $current = $current.length ? $current : $items.first();
            var index = $current.index() + delta;
            // Range check the new index
            index = (index < 0) ? 0 : ((index > $items.length) ? $items.length : index);
            $current.removeClass('current');
            $current = $items.eq(index).addClass('current');
            // Hide/show the next/prev
            $("#back").toggle(!$current.is($items.first()));
            $("#next").toggle(!$current.is($items.last()));
            $("#next2").toggle($current.is($items.last()));
        }
        $("#next").click(function () {
            updateItems(1);
        });
        $("#back").click(function () {
            updateItems(-1);
        });
        // Cause initial selection
        updateItems(0);

        function isOneChecked(form) {
            // All <input> tags...
            var chx = document.getElementsByTagName('input');
            var length = $('input:radio:checked').length;
            var total = "<?php echo $ji; ?>";
            // console.log(total);            
            if ($('input:radio:checked').length == total){
                    form.submit();
            }
            else if ($('input:radio:checked').length > 0) {
                var options = parseInt($('input:radio:checked').length);
                var questions = parseInt($('.apt_questions').length);
                var ans = questions - options;
                var answer = confirm("You have not answered " + ans + "questions" + '\n' + "Click OK to submit the test or Click cancel to continue");
                if (answer == true) {
                    form.submit();
                }
            }
            else {
                alert('Please select an option or else please logout');
            }
        }

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
        $(document).keydown(function(e) {
            if (e.keyCode == 76 && e.ctrlKey) {
                // alert("Don't Refresh dude");
                return false;
            }
        });
        
        window.onbeforeunload = function() {
            if(document.getElementById("timerText").textContent != ''){
                localStorage.setItem('elasped_time',document.getElementById("timerText").textContent);    
            }
            
        } 
        function elasped_time(time){
            var splitTimes1= time.split(':');
            seconds = (+splitTimes1[0]) * 60 * 60 + (+splitTimes1[1]) * 60 + (+splitTimes1[2]); 
            // console.log("seconds =====>",seconds); 
            return seconds;
        }

    </script>
@endsection
