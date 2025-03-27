@extends('layouts.header')
@section('content')
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <div id="page-content">
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Edit Question</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('questions') }}">Questions</a></li>
                            <li>Edit Questions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-title">
                        <h2>Question Form</h2>
                    </div>
                    <form action="{{ url('edit-question/'.base64_encode($question_details->question_id)) }}"
                          method="post" name='edit_question' class="form-horizontal form-bordered">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="section_id">Select section <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select id="section_id" name="section_id" class="form-control">
                                    <option value={{ $question_details->Section->id }}>{{$question_details->Section->section_name}}</option>

                                    @foreach($sections as $section)
                                        @if($section->id != $question_details->Section->id)
                                            <option value="{{ $section->id}}"> {{ $section->section_name }} </option>
                                        @endif
                                    @endforeach

                                </select>
                                @if ($errors->has('section_id'))
                                    <span class="error">{{ $errors->first('section_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="level_id">Select level <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select id="level_id" name="level_id" class="form-control">
                                    <option value={{ $question_details->QuestionLevel->id }}>{{$question_details->QuestionLevel->level }}</option>

                                    @foreach($questionlevels as $level)
                                        @if($level->id !=  $question_details->QuestionLevel->id)
                                            <option value="{{ $level->id}}"> {{ $level->level}} </option>
                                        @endif
                                    @endforeach

                                </select>
                                @if ($errors->has('level_id'))
                                    <span class="error">{{ $errors->first('level_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="question_name">Question Name <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
		                    <textarea id="question_name" name="question_name" class="form-control"
                            >{{ $question_details->question_name }}</textarea>
                                @if ($errors->has('question_name'))
                                    <span class="error">{{ $errors->first('question_name') }}</span>
                                @endif
                            </div>
                        </div>
                        @if ($question_details->question_info != "")
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="question_info">Question_info </label>
                                <div class="col-md-6">
                                    <textarea id="question_info" name="question_info" class="form-control"
                                    >{{ $question_details->question_info }}</textarea>
                                    @if ($errors->has('question_info'))
                                        <span class="error">{{ $errors->first('question_info') }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        {{-- <div class="form-group">
                            <label class="col-md-3 control-label" for="is_first_sub_question">SubQuestion </label>
                            <div class="col-md-6">
                                <select id="is_first_sub_question" name="is_first_sub_question" class="form-control">
                                    <option value="Yes" {{ ($question_details->is_first_sub_question== 'Yes') ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ ($question_details->is_first_sub_question == 'No') ? 'selected' : '' }}>No</option>
                                </select>
                                @if ($errors->has('is_first_sub_question'))
                                    <span class="error">{{ $errors->first('is_first_sub_question') }}</span>
                                @endif
                            </div>
                        </div> --}}
                        {{-- <div class="form-group"> --}}
                        {{-- <label class="col-md-3 control-label" for="marks">Marks <span class="required_class">*</span></label> --}}
                        {{-- <div class="col-md-6"> --}}
                        <input type="hidden" id="marks" name="marks" class="form-control"
                               value="{{ $question_details->marks }}">
                        {{-- @if ($errors->has('marks'))
                                            <span class="error">{{ $errors->first('marks') }}</span>
                                      @endif --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        <?php $i = 1; $j = 0; $k = 1;?>
                        @foreach ($options as $option)
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="options">Option <?php echo $i++; ?> <span
                                            class="required_class">*</span></label>
                                <div class="col-md-3 ">
                                    <input type="hidden" name="option_id_<?php echo $k++; ?>"
                                           value="{{$option->option_id}}">
                                    <input type="text" id="{{$option->option_id}}" name="option_<?php echo ++$j; ?>"
                                           class="form-control option" onchange="myFunction(this)"
                                           value="{{ $option->option_value }}"/>

                                </div>
                                @if ($errors->has('option_'.$j))
                                    <span class="error">{{ $errors->first('option_'.$j)}}
                      </span>
                                @endif
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="right_option_id">Right Option<span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select name="right_option_id" id="right_option_id" class="form-control">
                                    {{-- <option value={{ $question_details->Option->option_id }}>{{$question_details->Option->option_value}}</option> --}}
                                    @foreach($options as $option)
                                        @if ($option->option_id ==  $question_details->Option->option_id)
                                            <option value="{{ $option->option_value}}" class="form-control"
                                                    name="options" selected> {{ $option->option_value}}</option>
                                        @else
                                            <option value="{{ $option->option_value}}" class="form-control"
                                                    name="options"> {{ $option->option_value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('right_option_id'))
                                    <span class="error">{{ $errors->first('right_option_id') }}</span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="col-md-3 control-label" for="sort_order">Sort Order</label>
                            <div class="col-md-6">
                                <input type="text" id="sort_order" name="sort_order" class="form-control" value="{{ $question_details->sort_order }}">
                                @if ($errors->has('sort_order'))
                                              <span class="error">{{ $errors->first('sort_order') }}</span>
                                          @endif
                            </div>
                        </div> --}}
                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
                                <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                                <a href="{{ url('questions') }}" class="btn btn-effect-ripple btn-warning">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--CK Editor--}}
    <script>

        {{--var baseUrl = "<? 'http://'.$_SERVER['HTTP_HOST'].'/quiz/'; ?>";--}}
        var textarea = document.getElementById('question_info');
        if (textarea) {
            CKEDITOR.replace('question_info', {
                filebrowserUploadUrl :"{{route('upload',['_token' => csrf_token() ])}}",
                filebrowserUploadMethod :"form",
//                baseHref: baseUrl
            });

        }
        CKEDITOR.replace('question_name', {
            filebrowserUploadUrl :"{{route('upload',['_token' => csrf_token() ])}}",
            filebrowserUploadMethod :"form",
//            baseHref: baseUrl
        });

    </script>

    {{--Options --}}
    <script>
        function myFunction(el) {
            $('#right_option_id').html('');
            $('.option').each(function () {
                var currVal = $(this).val();
                if (currVal != '') {
                    var htm = '<option  value="' + currVal + '">' + currVal + '</option>';
                    $('#right_option_id').append(htm);
                }
                // else{
                //   $('#right_option_id').html('');
                // }
            });
        }

    </script>

    {{--Validation--}}
    <script>
        $(function () {
            $("form[name='edit_question']").validate({
                // Specify validation rules
                rules: {
                    section_id: "required",
                    level_id: "required",
                    question_name: "required",
                    option_1: "required",
                    option_2: "required",
                    option_3: "required",
                    option_4: "required",
                    marks: "required",
                    right_option_id: "required"
                },
                // Specify validation error messages
                messages: {
                    section_id: "Please select your Section",
                    level_id: "Please select your Level",
                    question_name: "Please enter question_name",
                    marks: "Please enter marks",
                    right_option_id: "Please select correct option",
                },
                submitHandler: function (form) {
                    form.submit();

                }
            });

        });
    </script>
@endsection
