@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Assessment Details</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li>Assessment Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('message'))
    <div class="alert alert-dismissible" role="alert" id="alertdivhiden">
        <button type="button" class="close" data-dismiss="alert" style="color:black" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    </div>
    @endif

    <div class="block full">
        <div class="block-title">
            <h2>Campuses</h2>
            <div class="pull-right">
                <a href="add-campus" class="btn btn-effect-ripple btn-primary" style="float: right;">Add</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" data-order='[[ 0, "desc" ]]' style="width:100%" id="campus_tbl">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Assessment Code</th>
                        <th>Assessment Date</th>
                        <th>Company Name</th>
                        <th>Pass Percentage</th>
                        <th>Total Questions</th>
                        <th>Password</th>
                        <th  class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $baseurl = "http://172.16.20.199/quiz/test/";
                	@endphp
                    @foreach($campuses as $key => $campus)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ @$campus->campus_name }}</td>
                            <td>{{date("d-m-Y", strtotime( @$campus->campus_date))}}</td>
                            <td>{{ @$campus->College->college_name }}</td>
                            <td>{{ @$campus->pass_percentage }} %</td>
                            <td>{{ @$campus->total_questions }}</td>
                            <td>{{ @$campus->password }}</td>
                            <td style="text-align:center"><a href="{{ url('edit-campus', base64_encode($campus->campus_id))}}" title="Update"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                            <a  style="margin-left:15px" class="delete_campus" data-campus-id="{{base64_encode($campus->campus_id)}}" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(function(){
    $("#campus_tbl").dataTable({
      "columnDefs": [
      { "orderable": false, "targets": -1 }
    ]
  });
});
$('.delete_campus').click(function (e) {
    e.preventDefault();
    var campus = $(this).attr('data-campus-id');
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
                            url: '{{ url("delete-campus") }}',
                            data: {'_token':"{{ csrf_token() }}",'campus':campus}
                        })
                        .done(function (response) {
                            if(response == 'notloggedin'){
                                location.reload();
                            }
                            else{
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
