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
                        <h1>Edit Assessment</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('campuses') }}">Assessments</a></li>
                            <li>Edit Assessment</li>
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
                @endforeach
            </div>
            </ul>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-title">
                        <h2>Assessment Form</h2>
                    </div>
                    <form action="{{ url('edit-campus/'.base64_encode($campus_details->campus_id)) }}" id="add_campus"
                          enctype="multipart/form-data" method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="campus_name">Assessment Name <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" id="campus_name" name="campus_name" class="form-control"
                                       value="{{ $campus_details->campus_name }}" required>
                                @if ($errors->has('campus_name'))
                                    <span class="error">{{ $errors->first('campus_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="campus_info">Assessment Info</label>
                            <div class="col-md-6">
                                <input type="text" id="campus_info" name="campus_info" class="form-control"
                                       value="{{  $campus_details->campus_info }}">
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
                                       autocomplete="off"
                                       value="{{ date('d-m-Y',  strtotime($campus_details->campus_date))}}" required>
                                @if ($errors->has('campus_date'))
                                    <span class="error">{{ $errors->first('campus_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="college_id">Company Name <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <select id="college_id" name="college_id" class="form-control" required>
                                    <option value={{ $campus_details->College->id }}>{{$campus_details->College->college_name}}</option>
                                    @foreach($colleges as $college)
                                        @if($college->id != $campus_details->College->id)
                                            <option value="{{ $college->id}}"> {{ $college->college_name }} </option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('college_id'))
                                    <span class="error">{{ $errors->first('college_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="pass_percentage">Pass Percentage <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="pass_percentage" id="pass_percentage" name="pass_percentage"
                                       class="" value="{{  $campus_details->pass_percentage }}" required>%
                                @if ($errors->has('pass_percentage'))
                                    <span class="error">{{ $errors->first('pass_percentage') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="total_questions">Total Questions <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" id="total_questions" class="total_questions" name="total_questions"
                                       class="" value="{{ $campus_details->total_questions }}" required readonly>
                                @if ($errors->has('total_questions'))
                                    <span class="error">{{ $errors->first('total_questions') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="questions">Questions <span
                                        class="required_class">*</span></label>
                            @if($campus_details->group_id == 0)
                                <div class="col-md-6">
                                    @foreach ($sections as $section)
                                        <input type="hidden" name="section_id" value="{{ $section->id }}">
                                        <label class="control-label">{{ $section->section_name }} :</label><br>
                                        @foreach ($levels[$section->id] as $level)
                                            <div class="col-md-3">
                                                <input type="hidden" name="level_id" value="{{ $level->level_id }}">
                                                <h5><b>{{ $level->level }}</b></h5>
                                            </div>
                                            <input class="question_count" type="number" max="{{ $level->max_count }}"
                                                   name="question_count[{{ $section->id }}][{{ $level->level_id }}]"
                                                   class="question_count"
                                                   value="{{ $questions[$section->id][$level->level_id] }}"><br>
                                            <br>
                                        @endforeach
                                    @endforeach
                                </div>
                            @else
                                <div class="col-md-6">
                                    <select class="form-control" name="predefined_questions" id="predefined_questions">
                                        @foreach($groups as $group)
                                            @if($campus_details->group_id == $group->id)
                                                <option value="{{ $group->id }}"
                                                        selected>{{$group->group_name}}</option>
                                            @else
                                                <option value="{{ $group->id }}"
                                                >{{$group->group_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="duration">Duration <span
                                        class="required_class">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="campus_time" name="campus_time" class="form-control"
                                       value="{{  $campus_details->min_val }}">
                                @if ($errors->has('campus_time'))
                                    <span class="error">{{ $errors->first('campus_time') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <select id="duration" name="duration" class="form-control">
                                    <option value={{ $campus_details->time }}>{{$campus_details->time}}</option>
                                    @if($campus_details->time != $campus_details->time_duration)
                                        <option value="{{ $campus_details->time_duration}}"> {{ $campus_details->time_duration }} </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="password">Password <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="password" id="password" name="password" class=""
                                       value="{{  $campus_details->password }}" readonly>
                                @if ($errors->has('password'))
                                    <span class="error">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Import Register Number</label>
                            <div class="col-md-6">
                                <input class="pull-right btn btn-primary" type="button" value="Template"
                                       onClick="window.location.href='/quiz/public/template/candidates.xls'">
                                <input type="file" name="candidates" accept="application/vnd.ms-excel" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Imported Register Numbers list</label>
                            <div class="col-md-6">
                                @if(!empty($register_numbers))
                                    @foreach ($register_numbers as $register_number)                                   
                                        {{ $register_number.',&nbsp;&nbsp;' }}                                                                            
                                    @endforeach
                                    <p style="padding-top:10px;"> Total Candidates: {{ $count_candidates }}</p>
                                @else
                                    <p style="color:red;">{{ 'Register numbers were not imported' }}</p>
                                @endif
                            </div>
                            <a id="delete-candidates" style="display:none" data-campus-id="{{base64_encode($campus_details->campus_id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </div>
                        <div class="form-group">
                            @if(!empty($register_numbers))
                            <label class="col-md-3 control-label" for="">Reset Candidate Details</label>
                            <div class="col-md-6">                        
                                <select id="delete_user" name="delete_user" class="form-control">
                                    <option value="">Select Candidate Number</option>   
                                    @foreach($get_reg_no as $register_number)                                                                                                           
                                            <option value="{{ $register_number->registration_number }}"> {{ $register_number->registration_number }} </option>                                                                                                                  
                                    @endforeach
                                </select>
                            </div>
                            <a id="delete-candidates-details" data-campus-id="{{base64_encode($campus_details->campus_id)}}" class="btn btn-danger">RESET</a>
                            @endif
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

{{-- Campus date  --}}
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

{{-- Sum the questions --}}
<script>
    $(document).on("change", ".question_count", function () {
        var sum = 0;
        $(".question_count").each(function () {
            sum += +$(this).val();
        });
        $(".total_questions").val(sum);
    });

    //        for predefined questions
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

{{-- Validation plugin --}}
<script>
    $(document).ready(function () {
        $('#add_campus').validate();
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

    $('#delete-candidates').click(function (e) {                
        e.preventDefault();
        var campus = $(this).attr('data-campus-id');
        bootbox.dialog({
            message: "Are you sure you want to Delete Register Numbers?",
            title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
            buttons: {
                success: {
                    label: "No",
                    className: "btn-success",
                    callback: function () {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Delete!",
                    className: "btn-danger",
                    callback: function () {
                        $.ajax({
                                type: 'POST',
                                url: '{{ url("delete-campus-users") }}',
                                data: {'_token':"{{ csrf_token() }}",'campus':campus}
                            })
                            .done(function (response) {
                                if(response == 'notloggedin'){
                                    location.reload();
                                }
                                else{
                                    bootbox.alert(response);
                                    // parent.fadeOut('slow');
                                    location.reload();
                                }

                            })
                            .fail(function () {
                                bootbox.alert('Error....');
                            })
                    }
                }
            }
        });
    });
</script>

<script>     
    $('#delete-candidates-details').click(function (e) {                
        e.preventDefault();
        var campus = $(this).attr('data-campus-id');            
        var registerNumber = $('#delete_user').val();
        if(registerNumber == ''){
            return alert('Please Select a Register Number');
        } 
        bootbox.dialog({
            message: "Are you sure you want to Delete Register Numbers?",
            title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
            buttons: {
                success: {
                    label: "No",
                    className: "btn-success",
                    callback: function () {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Yes!",
                    className: "btn-danger",
                    callback: function () {
                        $.ajax({
                                type: 'POST',
                                url: '{{ url("delete-user-details") }}',
                                data: {'_token':"{{ csrf_token() }}",'campus':campus,'reg_no': registerNumber}
                            })
                            .done(function (response) {
                                if(response == 'notloggedin'){
                                    location.reload();
                                }
                                else{
                                    bootbox.alert(response);
                                }

                            })
                            .fail(function () {
                                bootbox.alert('Please Select Correct Register Number');
                            })
                    }
                }
            }
        });
    });
</script>
@endsection
