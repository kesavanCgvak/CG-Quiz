@extends('layouts.app_home')
@section('content')
<style>
body{
  background-image: url('../public/img/bg11.jpg');
  background-size: 100%;
  background-repeat: no-repeat;
}
/* .container{
  margin-top: 30px;
  margin-left: 20px;
} */
.common-primary-head {
    text-align: center;
    margin: 15px 0px 40px 0px;
    color: black;
    border-bottom: 2px solid #6cd2e1;
    border-width: thin;
    padding-bottom: 15px;
}
.text-center{
  margin-top: 40px;
}
.college {
text-align: center;
 font-size: 20px;
 color:black;
}
ul{
    line-height:40px;
    /* color:white; */
}
li{
  font-size: 16px;
}
</style>

{{-- <div id="page-content"> --}}
<div class="container-fluid">
    {{-- <div class="main_page_content" id="main_page_content"> --}}
        {{-- <section class="satisfaction-form"> --}}
                  <div class="col-sm-12 text-center">
                    <span class="college"><h3>WELCOME  &nbsp;<b>{{ $College }}</b> &nbsp;STUDENTS</h3></span>
                  </div>
                  {{-- <div class="row"> --}}
                    {{-- <div class="col-sm-12"> --}}
                        <div class="survey-questionnaire">
                            {{-- <div class="row"> --}}
                                <div class="col-sm-offset-2 col-md-8">
                                    <h2 class="common-primary-head">General Instructions</h2>
                                    <ul>
                                        <li>Please read the following carefully before making an attempt to take the Test</li>
                                        <li>Please confirm that all the pages are intact and printed correctly.</li>
                                        <li>Do not keep with you books, calculators (including watch calculators), cellular phones, or any other device.</li>
                                        <li>Fill up all the details, as indicated on top of the Answer Sheet</li>
                                        <li>Directions for answering the questions are given in the test booklet before each group of questions to which they apply. Read these directions carefully and answer the questions</li>
                                        <li>Select the appropriate option against each question in the answer sheet. <br>
                                        </li>
                                        <!-- <li>If you wish to change the answer do it as show below<br>
                                        A	B</li> -->
                                        <!-- <li>Do not circle more than one option; in that case the answer will be treated null and void.</li> -->
                                        <!-- <li>Do not write and make any stray marks, smudges on the question booklet and answer sheet.</li> -->
                                        <!-- <li>Do not do any rough work on the question booklet and answer sheet. Extra sheets will be provided for the rough work.</li> -->
                                        <li>On completion of the test, you are required to submit the question booklet, answer sheet and the rough sheet.</li>

                                    </ul>

                                    <h3>
                                        <a href="{{ url('user-details',base64_encode($campus->campus_id))}}" >
                                            Click here to register
                                        </a>
                                        <!-- <form id="frm-surveyform" action="" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form> -->
                                    </h3>
                                </div>
                            {{-- </div> --}}
                        </div>
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </section> --}}

    </div>
{{-- </div> --}}
@endsection
