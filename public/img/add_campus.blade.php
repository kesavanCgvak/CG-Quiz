@extends('layouts.header')
@section('content')
    <style media="screen">
        .pass_percentage, .total_questions, .question_count {
            border: 1px solid lightgray;
            border-radius: 2px;
        }
    </style>
    <div id="page-content">
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Create Campus</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('campuses') }}">Campuses</a></li>
                            <li>Create Campus</li>
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
                        <h2>Campus Form</h2>
                        <input class="pull-right btn btn-primary" type="button" value="Template"
                               onClick="window.location.href='/quiz/public/template/candidates.xls'">
                    </div>
                    <form action="{{ url('add-campus') }}" method="post" enctype="multipart/form-data" id="add_campus"
                          class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="campus_name">Campus Name <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" id="campus_name" name="campus_name" class="form-control"
                                       value="{{ old('campus_name') }}">
                                @if ($errors->has('campus_name'))
                                    <span class="error">{{ $errors->first('campus_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="campus_info">Campus Info</label>
                            <div class="col-md-6">
                                <textarea type="text" rows="4" id="campus_info" name="campus_info" class="form-control"
                                          value="{{ old('campus_info') }}">{{ old('campus_info') }}</textarea>
                                @if ($errors->has('campus_info'))
                                    <span class="error">{{ $errors->first('campus_info') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="campus_date">Campus Date <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" id="campus_date" name="campus_date" class="form-control"
                                       autocomplete="off" value="{{ old('campus_date') }}">
                                @if ($errors->has('campus_date'))
                                    <span class="error">{{ $errors->first('campus_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="select_college">Select College <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select id="select_college" name="select_college" class="form-control"
                                        value="{{ old('select_college') }}">
                                    <option value="">Select College</option>
                                    @foreach($colleges as $college)
                                        <option value="{{ $college->id}}"
                                                @if (old('select_college') == $college->id) selected="selected" @endif> {{     $college->college_name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('select_college'))
                                    <span class="error">{{ $errors->first('select_college') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="gd_candidates">Group Discussion Attendees
                                {{--<span class="required_class">*</span>--}}</label>
                            <div class="col-md-6">
                                <input type="number" class="pass_percentage" name="gd_candidates" min="3"
                                       value="{{ old('gd_candidates')}}">
                                @if ($errors->has('gd_candidates'))
                                    <span class="error">{{ $errors->first('gd_candidates') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="pass_percentage">Pass Percentage<span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="number" class="pass_percentage" name="pass_percentage" min="3"
                                       value="{{ old('pass_percentage')}}">%
                                @if ($errors->has('pass_percentage'))
                                    <span class="error">{{ $errors->first('pass_percentage') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="total_questions">Total Questions <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="number" class="total_questions" name="total_questions" min="3"
                                       value="{{ old('total_questions')}}">
                                @if ($errors->has('total_questions'))
                                    <span class="error">{{ $errors->first('total_questions') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="questions">Questions <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
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
                                               class="question_count" value="{{ old("question_count") }}" required><br><br>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="duration">Duration <span
                                        class="required_class">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="campus_time" name="campus_time" class="form-control"
                                       value="{{ old('campus_time') }}">
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
                            <label class="col-md-3 control-label" for="password">Campus Password<span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="password" name="password" value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Candidates Register Number</label>
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
        $(document).on("change", ".question_count", function () {
            var sum = 0;
            $(".question_count").each(function () {
                sum += +$(this).val();
            });
            $(".total_questions").val(sum);
        });
    </script>

    {{-- Jquery Plugin validation --}}
    <script>
        $(document).ready(function () {
            $('#add_campus').validate({ // initialize the plugin
                rules: {
                    campus_name: {
                        required: true
                    },
                    campus_date: {
                        required: true
                    },
                    select_college: {
                        required: true
                    },
                    pass_percentage: {
                        required: true
                    },
                    total_questions: {
                        required: true
                    },
                    campus_time: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    // candidates:{
                    //   required: true
                    // }
                },
            });
        });

    </script>
@endsection
