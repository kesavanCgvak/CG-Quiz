@extends('layouts.header')
@section('content')


    <style media="screen">
        .pass_percentage, .total_questions, .question_count, .password {
            border: 1px solid lightgray;
            border-radius: 2px;
        }
    </style>
    <div id="page-content">
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Create Assessment</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('campuses') }}">Assessments</a></li>
                            <li>Create Assessment</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if($errors->any())
            <div class="alert  alert-danger">
                <button type="button" class="close" data-dismiss="alert" style="color:black" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                {{-- <span class="error">{{ $error }}</span> --}}
                @endforeach
            </div>
            </ul>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-title">
                        <h2>Assessment Form</h2>
                        <input class="pull-right btn btn-primary" type="button" value="Template"
                               onClick="window.location.href='/quiz/public/template/candidates.xls'">
                    </div>
                    <form action="{{ url('add-campus') }}" method="post" enctype="multipart/form-data" id="add_campus"
                          class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="campus_name">Assessment Code <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" id="campus_name" name="campus_name" class="form-control"
                                       value="{{ old('campus_name') }}" required>
                                @if ($errors->has('campus_name'))
                                    <span class="error">{{ $errors->first('campus_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="campus_info">Assessment Info</label>
                            <div class="col-md-6">
                                <textarea type="text" rows="4" id="campus_info" name="campus_info" class="form-control"
                                          value="{{ old('campus_info') }}">{{ old('campus_info') }}</textarea>
                                @if ($errors->has('campus_info'))
                                    <span class="error">{{ $errors->first('campus_info') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="campus_date">Assessment Date <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" id="campus_date" name="campus_date" class="form-control"
                                       autocomplete="off" value="{{ old('campus_date') }}" required>
                                @if ($errors->has('campus_date'))
                                    <span class="error">{{ $errors->first('campus_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="select_college">Select Company <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select id="select_college" name="select_college" class="form-control"
                                        value="{{ old('select_college') }}" required>
                                    <option value="">Select Company</option>
                                    @foreach($colleges as $college)
                                        <option value="{{ $college->id}}"
                                                @if (old('select_college') == $college->id) selected="selected" @endif> {{ $college->college_name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('select_college'))
                                    <span class="error">{{ $errors->first('select_college') }}</span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="col-md-3 control-label" for="gd_candidates">Total Candidates Attended the Group Discussion
                                </label>
                            <div class="col-md-6">
                                <input type="number" class="pass_percentage" name="gd_candidates"
                                       value="{{ old('gd_candidates')}}">
                                @if ($errors->has('gd_candidates'))
                                    <span class="error">{{ $errors->first('gd_candidates') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="gd_sorted_candidates">Total Cadidates Shortlisted in Group Discussion
                               </label>
                            <div class="col-md-6">
                                <input type="number" class="pass_percentage" name="gd_sorted_candidates"
                                       value="{{ old('gd_sorted_candidates')}}">
                                @if ($errors->has('gd_sorted_candidates'))
                                    <span class="error">{{ $errors->first('gd_sorted_candidates') }}</span>
                                @endif
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="pass_percentage">Pass Percentage<span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="number" class="pass_percentage" name="pass_percentage"
                                       value="{{ old('pass_percentage')}}" required>%
                                @if ($errors->has('pass_percentage'))
                                    <span class="error">{{ $errors->first('pass_percentage') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="total_questions">Total Questions <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="number" class="total_questions" name="total_questions"
                                       value="{{ old('total_questions')}}" required readonly>
                                @if ($errors->has('total_questions'))
                                    <span class="error">{{ $errors->first('total_questions') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="questions">Questions <span
                                        class="required_class">*</span></label>
                            <div class="col-md-4" id="select-questions" style="display:inline;">
                                <input type="radio" size="50" class="default-questions" name="questions"
                                       id="default-questions">Default
                                Questions
                                <input type="radio" class="predefined-questions" name="questions"
                                       id="predefined-questions">Predefined
                                Questions
                            </div>
                            <br>

                            {{--Adding Default Questions--}}
                            <div class="col-md-6 questions1" id="questions1" style="display:none;">
                                @foreach ($sections as $section)
                                    <input type="hidden" name="section_id" value="{{ $section->id }}">
                                    <label class="control-label">{{ $section->section_name }} :</label><br>
                                    @foreach ($levels[$section->id] as $level)
                                        <div class="col-md-3">
                                            <input type="hidden" name="level_id" value="{{ $level->level_id }}">
                                            <h5 style="color:gray"><b>{{ $level->level }}</b></h5>
                                        </div>
                                        <input type="number" max="{{ $level->max_count }}"
                                               name="question_count[{{ $section->id }}][{{ $level->level_id }}]"
                                               class="question_count" value="{{ old("question_count") }}"><br>
                                        <br>
                                    @endforeach
                                @endforeach
                            </div>

                            {{--Adding Predefined Questions--}}
                            <div class="col-md-6" id="questions2" style="display:none;">
                                <select class="form-control" name="predefined_questions" id="predefined_questions">
                                    <option value="">{{ 'Select group questions' }}</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label" for="duration">Duration <span
                                        class="required_class">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="campus_time" name="campus_time" class="form-control"
                                       value="{{ old('campus_time') }}" required>
                                @if ($errors->has('campus_time'))
                                    <span class="error">{{ $errors->first('campus_time') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <select id="duration" name="duration" class="form-control"
                                        value="{{ old('duration') }}">
                                    <!-- <option value="" selected="true" disabled="disabled">Time Duration</option> -->
                                    <option value="Hour">Hour</option>
                                    <option value="Minutes">Minutes</option>
                                </select>
                                @if ($errors->has('duration'))
                                    <span class="error">{{ $errors->first('duration') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="password">Assessment Password<span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="password" name="password" value="{{ old('password') }}"
                                       required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Import Employee/Registration Number</label>
                            <div class="col-md-6">
                                <input class="pull-right btn btn-primary" type="button" value="Template"
                                       onClick="window.location.href='/quiz/public/template/candidates.xls'">
                                <input type="file" name="candidates" accept="application/vnd.ms-excel" value="">
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
                                <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                                <a href="{{ url('campuses') }}" class="btn btn-effect-ripple btn-warning">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{--Scripts--}}
    <script>
        $(document).ready(function () {
            $('input[id$=campus_date]').datepicker({});
        });
        $('input[id$=campus_date]').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $('input[type=number]').on('wheel', function (e) {
            return false;
        });
    </script>

    {{-- To get total questions --}}
    <script>
        //        for default selection count
        $(document).on("change", ".question_count", function () {
            var sum = 0;
            $(".question_count").each(function () {
                sum += +$(this).val();
            });
            $(".total_questions").val(sum);
        });

        //        for predefined questions count
        $(document).on("change", "#predefined_questions", function () {
            console.log(this.value);
            var count = this.value;
            $.ajax({
                type: 'POST',
                url: '{{ url("groupques-count") }}',
                data: {'_token': "{{ csrf_token() }}", 'count': count}
            })
                .done(function (response) {
                    $(".total_questions").val(response);
                })
                .fail(function () {
                    bootbox.alert('Select a proper group');
                })

        });

    </script>


    {{--Display Add Questions--}}
    <script>

        $("#default-questions").on("click", function () {
            $('#questions1').removeAttr("style");
            $('#questions2').attr("style", "display:none");
        });

        $("#predefined-questions").on("click", function () {
            $('#questions1').attr("style", "display:none");
            $('#questions2').removeAttr("style");

        });

    </script>

    {{-- Jquery Plugin validation --}}
    <script>
        $(document).ready(function () {
            $('#add_campus').validate({
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "questions") {
                        error.insertAfter("#select-questions");
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    'questions': 'required',
                }
            });
            $('.question_count').each(function () {
                $(this).rules("add",
                    {
                        required: true,
                        messages: {
                            required: "This Field is required",
                            max: "Only {0} questions available in this level",
                        }
                    });
            });
        });

    </script>

    <script>
        $('select[multiple]').multiselect({
            columns: 0,
            placeholder: 'Select Questions',
        });
    </script>
@endsection
