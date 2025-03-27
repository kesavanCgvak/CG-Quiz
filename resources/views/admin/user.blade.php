@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Users Details</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li>Users Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('message'))
    <div class="alert alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" style="color:black" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    </div>
    @endif

    <div class="block full">
        <div class="block-title">
            <h2>Users</h2>
           {{--  <div class="pull-right">
                <a href="add-college" class="btn btn-effect-ripple btn-primary" style="float: right;">Add</a>
            </div> --}}
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" style="width:100%" id="user_tbl">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Registration Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->registration_number}}</td>
                            <td style="text-align:center">{{-- <a href="{{ url('edit-college', encrypt($college->id))}}" title="Update"><i class="fa fa-eye"></i></a>&nbsp;&nbsp; --}}
                            <a  style="margin-left:15px" class="delete_user" data-user-id="{{base64_encode($user->id)}}" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>
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
    $("#user_tbl").dataTable();
});
$('.delete_user').click(function (e) {
    e.preventDefault();
    var user = $(this).attr('data-user-id');
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
                            url: '{{ url("delete-user") }}',
                            data: {'_token':"{{ csrf_token() }}",'user':user}
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
@endsection
