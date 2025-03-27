@extends('layouts.header')
@section('content')

    <div id="page-content">
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Group Questions Details</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li>Group Questions</li>
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
                <h2>Group Questions</h2>
                <div class="pull-right">
                    <a href="add-prequestions" class="btn btn-effect-ripple btn-primary" style="float: right;">Add</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" style="width:100%" id="prequestion">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Group Question Name</th>
                        <th>Total Questions</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pre_questions as $key => $pre_question)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $pre_question->group_name }}</td>
                            <td>{{ count(unserialize($pre_question->pre_questions))}} {{ '('}}
                                @foreach ($sections as $section)
                                    @if (!empty($ques_sections) && isset($ques_sections[$pre_question->id]))  
                                        @foreach ($ques_sections[$pre_question->id] as $key => $ques_section)                                                                      
                                            @if($section->id == $key)
                                                @foreach($ques_section as $ques)
                                                    @foreach($ques as $keys => $values)
                                                        <b>{{$keys.'-'.$values.'&nbsp;&nbsp;&nbsp;'}}</b>
                                                    @endforeach
                                                @endforeach
                                            @endif                                   
                                        @endforeach
                                    @else
                                        <b>No Data</b> {{-- Display a fallback if there are no questions --}}
                                    @endif                              
                                @endforeach
                                {{ ')'}}
                            </td>
                            <td style="text-align:center"><a
                                        href="{{ url('edit-prequestions', base64_encode($pre_question->id))}}" title="Update"><i
                                            class="fa fa-edit"></i></a>&nbsp;&nbsp
                                <a style="margin-left:15px" class="delete_prequestion"
                                   data-preques-id="{{base64_encode($pre_question->id)}}" href="javascript:void(0)"
                                   title="Delete"><i class="fa fa-trash"></i></a>
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
            $("#prequestion").DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": -1}
                ]
            });
        });
        $('.delete_prequestion').click(function (e) {
            e.preventDefault();
            var prequestion = $(this).attr('data-preques-id');
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
                                url: '{{ url("delete-prequestions") }}',
                                data: {'_token': "{{ csrf_token() }}", 'preQuestion': prequestion}
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
    </div>



    {{--Hide alert div--}}
    <script>
        setTimeout(function () {
            $('#alertdivhiden').hide('slow');
        }, 1000);
    </script>
@endsection
