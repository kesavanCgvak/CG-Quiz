@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Company Details</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li>Company Details</li>
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
            <h2>Company</h2>
            <div class="pull-right">
                <a href="add-college" class="btn btn-effect-ripple btn-primary" style="float: right;">Add</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" style="width:100%" id="college_tbl">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>Contact Name</th>
                        <th>Contact Email</th>
                        <th>Phone Number</th>
                        <th  class="text-center">Action</th>
                    </tr>
                </thead>
                @php
                //   $contact_email_count = count($contact_email);
                  // echo $contact_email;
                  // exit;
                @endphp
                <tbody>
                	@foreach($colleges as $key => $college)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $college->college_name }}</td>
                            <td>{{ $college->college_address }}</td>
                            <td>{{ $college->placement_officer_name }}</td>
                            <td>{{ implode(",\n",$contact_email[$college->id]) }}</td>
                            <td>{{ implode(",\n",$phone_number[$college->id]) }}</td>
                            <td style="text-align:center"><a href="{{ url('edit-college', base64_encode($college->id))}}" title="Update"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                            <a  style="margin-left:15px" class="delete_college" data-college-id="{{base64_encode($college->id)}}" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>
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
    $("#college_tbl").DataTable({
    "columnDefs": [
    { "orderable": false, "targets": -1 }
  ]
});
});
$('.delete_college').click(function (e) {
    e.preventDefault();
    var college = $(this).attr('data-college-id');
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
                            url: '{{ url("delete-college") }}',
                            data: {'_token':"{{ csrf_token() }}",'college':college}
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
