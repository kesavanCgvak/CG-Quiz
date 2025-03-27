@extends('layouts.header')
@section('content')

    <div id="page-content">
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>All Questions</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li>Questions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if(Session::has('message'))
            <div class="alert alert-dismissible" role="alert" id="alertdivhiden">
                <button type="button" class="close" data-dismiss="alert" style="color:black" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            </div>
        @endif

        <div class="block full">
            <div class="block-title">
                <h2>Questions</h2>
                <div class="pull-right">
                    {{--<div class="dropdown">--}}
                    {{--<button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">--}}
                    {{--Add Questions--}}
                    {{--<span class="caret"></span></button>--}}
                    {{--<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">--}}
                    {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="add-parent-question">Add--}}
                    {{--Parent Question</a></li>--}}
                    {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="add-sub-question">Add Sub--}}
                    {{--Question</a></li>--}}
                    {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="add-question">Add--}}
                    {{--Question</a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--<a href="add-sub-question" class="btn btn-effect-ripple btn-primary" style="margin-right:10px;">Add Sub Questions</a>--}}
                    <a href="add-question" class="btn btn-effect-ripple btn-primary" style="float: right;">Add</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" style="width:100%" id="questions_tbl">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        {{-- <th>Section</th> --}}
                        <th>Section Name</th>
                        <th>Question</th>
                        <th style="display:none">Group Question</th>
                        <th  class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $key => $question)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            {{-- <td>{{ $question->section }}</td> --}}
                            <td>{{ $question->section_name }}</td>
                            <td>{!! $question->question_name !!}</td>
                            <td style="display:none">{!! $question->question_info !!}</td>
                            <td style="text-align:center"><a
                                        href="{{ url('edit-question', base64_encode($question->question_id))}}"
                                        title="Update" target=""><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                <a style="margin-left:15px" class="delete_question"
                                   data-question-id="{{base64_encode($question->question_id)}}"
                                   href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            var groupColumn = 3;
            $("#questions_tbl").dataTable({
                "columnDefs": [
                    {"orderable": false, "targets": -1}
                ],
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var last = null;
                    api.column(groupColumn, {page: 'current'}).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }

            });
        });
        $('.delete_question').click(function (e) {
            e.preventDefault();
            var question_id = $(this).attr('data-question-id');
            var parent = $(this).parent("td").parent("tr");
            bootbox.dialog({
                message: "Are you sure you want to Delete ?",
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
                                url: '{{url("delete-question")}}',
                                data: {'_token': "{{ csrf_token() }}", 'question': question_id}
                            })
                                .done(function (response) {
                                    if (response == 'notloggedin') {
                                        location.reload();
                                    }
                                    else {
                                        bootbox.alert(response);
                                        parent.fadeOut('slow');
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

    {{--Hide alert div--}}
    <script>
        setTimeout(function () {
            $('#alertdivhiden').hide('slow');
        }, 1000);
    </script>
@endsection
