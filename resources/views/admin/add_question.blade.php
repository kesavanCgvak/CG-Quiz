
@extends('layouts.header')
@section('content')
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    {{--<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>--}}
    <div id="page-content">
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Create Question</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('questions') }}">Question</a></li>
                            <li>Create Question</li>
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
                        @php
                            echo URL::to('/');

                        @endphp
                    </div>
                    <form action="{{ url('add-question') }}" method="post" class="form-horizontal form-bordered"
                          name="add_question">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="section">Section <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select id="section" name="section" class="form-control">
                                    <!-- <option value="">Please select section</option> -->
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" {{ (old('section') == $section->id) ? 'selected' : '' }}>{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('section'))
                                    <span class="error">{{ $errors->first('section') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="level">Level <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select id="level" name="level" class="form-control">
                                    <option value="">Please select level</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" {{ (old('level') == $level->id) ? 'selected' : '' }}>{{ $level->level }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('level'))
                                    <span class="error">{{ $errors->first('level') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="question_name">Question Name <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <textarea id="question_name" name="question_name"
                                          class="form-control">{{ old('question_name') }}</textarea>
                                @if ($errors->has('question_name'))
                                    <span class="error">{{ $errors->first('question_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="question_info">Parent Question</label>
                            <div class="col-md-6">
                                <textarea id="question_info" name="question_info"
                                          class="form-control">{{ old('question_info') }}</textarea>
                                @if ($errors->has('question_info'))
                                    <span class="error">{{ $errors->first('question_info') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="sub_question">Is Sub Question</label>
                            <div class="col-md-6">
                                <input type="checkbox" style="  width: 30px; height: 20px;" id="sub_question">
                                <div id="mycheckboxdiv" style="display:none">
                                    <select name="sub_question" id="parent-question" class="form-control">
                                        <option value="">Select a Parent Question</option>
                                        @foreach($question_data as $data)
                                            <option value={{  $data->question_number }}>{!! $data->question_info !!}</option><br>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group"> --}}
                        {{-- <label class="col-md-3 control-label" for="marks">Marks <span class="required_class">*</span></label> --}}
                        {{-- <div class="col-md-6"> --}}
                        <input type="hidden" id="marks" name="marks" class="form-control" value="{{ 1 }}">
                        {{-- @if ($errors->has('marks'))
                            <span class="error">{{ $errors->first('marks') }}</span>
                        @endif --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        @php
                            $i=0;
                        @endphp
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="option_value1">Option1 <span
                                        class="required_class">*</span></label>
                            <?php $i = 1;?>
                            <div class="col-md-3 ">
                                <input type="text" id=<?php echo "option_".$i++;?> name="option_1" class="form-control option"
                                       onchange="myFunction(this)" value="{{ old('option_1') }}"/>
                            </div>
                            @if ($errors->has('option_1'))
                                <span class="error">{{ $errors->first('option_1') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="option_value">Option2 <span
                                        class="required_class">*</span></label>
                            <div class="col-md-3 ">
                                <input type="text" id=<?php echo "option_".$i++;?> name="option_2" class="form-control option"
                                       onchange="myFunction(this)" value="{{ old('option_2') }}"/>
                            </div>
                            @if ($errors->has('option_2'))
                                <span class="error">{{ $errors->first('option_2') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="option_value">Option3 <span
                                        class="required_class">*</span></label>
                            <div class="col-md-3 ">
                                <input type="text" id=<?php echo "option_".$i++;?> name="option_3" class="form-control option"
                                       onchange="myFunction(this)" value="{{ old('option_3') }}"/>
                            </div>
                            @if ($errors->has('option_3'))
                                <span class="error">{{ $errors->first('option_3') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="option_value">Option4 <span
                                        class="required_class">*</span></label>
                            <div class="col-md-3 ">
                                <input type="text" id=<?php echo "option_".$i++;?> name="option_4" class="form-control option"
                                       onchange="myFunction(this)" value="{{ old('option_4') }}"/>
                            </div>
                            @if ($errors->has('option_4'))
                                <span class="error">{{ $errors->first('option_4') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="right_option">Right Option <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select class="form-control" id="right_option" name="right_option">
                                    <option value=''>Please select right option</option>
                                </select>
                                @if ($errors->has('right_option'))
                                    <span class="error">{{ $errors->first('right_option') }}</span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="col-md-3 control-label" for="sort_order">Sort Order</label>
                            <div class="col-md-1">
                                <input type="text" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order') }}">
                            </div>
                        <div class="col-md-6 col-md-offset-3">
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
        CKEDITOR.replace( 'question_name',{
//            token : "CSRF-Token",
        filebrowserUploadUrl :"{{route('upload',['_token' => csrf_token() ])}}",
        filebrowserUploadMethod :"form",
//        baseHref : baseUrl,
        });
        // Add plugin
//        extraPlugins: 'imageuploader'

        CKEDITOR.replace( 'question_info', {
            filebrowserUploadUrl: "{{route('upload',['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: "form",
//            baseHref : baseUrl,
        });

        CKEDITOR.editorConfig = function( config ) {
            config.enterMode = CKEDITOR.ENTER_BR // pressing the ENTER Key puts the <br/> tag
            config.shiftEnterMode = CKEDITOR.ENTER_P; //pressing the SHIFT + ENTER Keys puts the <p> tag
        };
    </script>

    {{--Choose Correct Option --}}
    <script>
        function myFunction(el) {
            $('#right_option').html('');
            var selc = '<option value="">Please select right option</option>';
            $('#right_option').append(selc);
            $('.option').each(function () {
                var currVal = $(this).val();
                if (currVal != '') {
                    var htm = '<option  value="' + currVal + '">' + currVal + '</option>';
                    $('#right_option').append(htm);
                }
            });
        }
    </script>

    {{--Add Question Validation--}}
    <script>
        $(function () {
            $("form[name='add_question']").validate({
                // Specify validation rules
                rules: {
                    section: "required",
                    level: "required",
                    question_name: "required",
                    marks: "required",
                    option_1: "required",
                    option_2: "required",
                    option_3: "required",
                    option_4: "required",
                    right_option: "required"
                },
                // Specify validation error messages
                messages: {
                    section: "Please select your Section",
                    level: "Please select your Level",
                    question_name: "Please enter question_name",
                    marks: "Please enter marks",
                    right_option: "Please select correct option",
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            $("[name^=option_value]").each(function () {
                $(this).rules("add", {
                    required: true,
                    checkValue: true,

                });
            });
        });
    </script>

        {{--Show Parent Questions--}}
        <script>
            $('#sub_question').change(function () {
                $(this).next('div').toggle();
            });

        </script>
@endsection
