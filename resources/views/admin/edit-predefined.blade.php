@extends('layouts.header')
@section('content')

    <div id="page-content">
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Edit Group Questions</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('predefined-questions') }}">Group Questions</a></li>
                            <li>Edit Group Questions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-title">
                        <h2>Group Questions Form</h2>
                    </div>
                    <form action="{{ url('edit-prequestions/'.base64_encode($get_group->id)) }}" id="edit_prequestions"
                          method="post" class="form-horizontal form-bordered">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="group_name">Group Name <span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                <input type="text" id="group_name" name="group_name" class="form-control"
                                       value="{{ $get_group->group_name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="predefined_question_names">Questions<span
                                        class="required_class">*</span></label>
                            <div class="col-md-6">
                                @foreach($sections as $section)
                                    <input class="form-control" type="text" value="{{ $section->section_name }}"
                                           readonly>
                                    @php
                                        $i = 1;
                                    @endphp
                                    <select class="form-control" multiple name="predefined_questions[]"
                                            id="predefined_ques"
                                            size="20" style="" required>
                                        @foreach($questions[$section->id] as $question)

                                            @if(empty($question->question_info))
                                                @if(in_array($question->question_id,$get_questions))
                                                    <option value="{{ $question->question_id }}" selected>
                                                        {{$i}}).&nbsp {!! $question->question_name !!}</option>
                                                @else
                                                    <option value="{{ $question->question_id }}">
                                                        {{$i}}).&nbsp {!! $question->question_name !!}</option>
                                                @endif

                                            @else
                                                @if(in_array($question->question_id,$get_questions))
                                                    <option value="{{ $question->question_id }}" selected>
                                                        {{$i}}).&nbsp{!! $question->question_info !!}</option>
                                                @else
                                                    <option value="{{ $question->question_id }}">
                                                        {{$i}}).&nbsp{!! $question->question_info !!}</option>
                                                @endif
                                            @endif
                                            @php
                                                $i++;
                                            @endphp

                                        @endforeach
                                    </select><br>

                                @endforeach
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
                                <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                                <a href="{{ url('predefined-questions') }}" class="btn btn-effect-ripple btn-warning">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Validation --}}
    <script>
        $(document).ready(function () {
            $('#edit_prequestions').validate({ // initialize the plugin
                rules: {
                    group_name: {
                        required: true
                    },

                },

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
