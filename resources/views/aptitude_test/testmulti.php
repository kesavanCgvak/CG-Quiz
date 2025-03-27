@extends('layouts.app_home')
@section('content')
@php
//echo '<pre>';print_r($questions);die;
@endphp

<style>
/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}



/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
  margin:auto;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}
</style>

<div id="page-content">
    <div class="main_page_content" id="main_page_content">
        <section class="satisfaction-form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="survey-questionnaire">
                            <form action="" method="post" id="add_command" name="add_command">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-offset-2 col-md-8">
                                    <div class="tab">
                                        <h1 class="common-primary-head">Section 1: Quantitative Ability</h1>
                                        
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach($questions as $question)
                                        <div class="form-group">
                                        @if($question->is_first_sub_question && !empty($question->question_info))
                                        <label class="question"> {{ $question->question_info }}</label>
                                        @endif
                                            <label class="question">{{ $question->question_id }}. {{ $question->question_name }}</label>
                                            @php
                                            $k='A';
                                            @endphp
                                            @foreach ($question->options as $option)
                                            <div class="radio">
                                                <input type="radio" class ="{{ $question->question_id }}" name="{{ $question->question_id }}" value="{{ $option->option_id }}" id="{{ $question->question_id }}{{ $option->option_id }}">
                                                <label for="{{ $question->question_id }}{{ $option->option_id }}"> <span>{{ $k.')' }}</span> {{ $option->option_value }}</label>
                                            </div>
                                            @php
                                        $k++;
                                        @endphp
                                       
                                        @endforeach
                                            <span class="{{ $question->question_id }}-error"></span> 
                                        </div>

                                        @php
                                        $i++;
                                        @endphp
                                        @if($question->question_id == 15)
                                        </div>
                                        <div class="tab">
                                        <h1 class="common-primary-head">Section 2: Verbal Ability</h1>
                                        @elseif($question->question_id == 30)
                                        </div>
                                        <div class="tab">
                                        <h1 class="common-primary-head">Section 3: Logical Ability</h1>
                                        @endif
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div style="overflow:auto;">
                                    <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                                {{--<div class="form-group text-center">
                                    <div class="">
                                        <input type="submit" id="impact-action-button" name="submit" class="btn btn-effect-ripple btn-info" value="Submit">
                                        <!--                                        <a href="{{ url('login') }}" class="btn btn-effect-ripple btn-danger">Cancel</a>-->
                                    </div>
                                </div>--}}
                                <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  
  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>    

{{--<script type="text/javascript">
    (function ($, W, D)
    {
    var JQUERY4U = {};
    JQUERY4U.UTIL =
    {
    setupFormValidation: function ()
    {
    //form validation rules
    $("#add_command").validate({

    rules: {
    @foreach ($data as $node)
            @if ($node['field_type'] == 4)
    {{ $node['question_id'] }}:{required: true},
            @elseif($node['field_type'] == 3)
            "{{ $node['question_id'] }}[]": {
            required: true,
                    minlength: {{ $node['min_select'] }},
                    maxlength: {{ $node['max_select'] }}
            },
            @elseif($node['field_type'] == 2)
    {{ $node['question_id'] }}:{required: true},
            @endif
            @endforeach
    },
            messages: {
            @foreach ($data as $node)
                    @if ($node['field_type'] == 4)
            {{ $node['question_id'] }}: "Please select option !",
                    @elseif($node['field_type'] == 3)
                    "{{ $node['question_id'] }}[]": "Please select checkbox ! minimum:{{ $node['min_select'] }}, maximum : {{ $node['max_select'] }}",
                    @elseif($node['field_type'] == 2)
            {{ $node['question_id'] }}: "Please select radio option !",
                    @endif
                    @endforeach
            }, errorPlacement: function(error, element){
    var classname = element.parents(".form-group").find("span").attr('class');
    $('.' + classname).html(error);
    },
            submitHandler: function (form) {
            form.submit();
            }
    });
    }
    }
    //when the dom has loaded setup form validation rules
    $(D).ready(function ($) {
    JQUERY4U.UTIL.setupFormValidation();
    });
    })(jQuery, window, document);
</script> --}}

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = $(".tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("add_command").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  console.log(x);
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if ( ! y[i].checked ) {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
  window.scrollTo(0, 0);
}
</script>


@endsection