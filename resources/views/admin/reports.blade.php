@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>User Reports</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('campus-reports') }}">Campus Reports</a></li>
                        <li>User Reports</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

  {{--   @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif --}}

    <div class="block full">
        <div class="block-title">
            <h2>User Reports</h2>
            {{-- <div class="pull-right">
                <a href="add-college" class="btn btn-effect-ripple btn-primary" style="float: right;">Add</a>
            </div> --}}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="width:100%" id="reports_tbl">
                <thead>
                    <tr>
                        <th>Test Date</th>
                        <th>Reg.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        @foreach($headingTitle as $key =>$value)
                            <th>{{ $value }}</th>
                        @endforeach
                        <th>Overall Precentage</th>
                        <th>Result</th>
                        {{-- <th>View</th> --}}
                    </tr>
                </thead>
                <tbody>  <?php
                  $headingCount = count($headingTitle);
                ?>
                   @foreach($reports as $report)
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($report->test_completed_date))}}</td>
                            <td>{{ $report->registration_number}}</td>
                            <td>{{ $report->name}}</td>
                            <td>{{ $report->email}}</td>
                            @for($i=0; $i<$headingCount; $i++)
                              <td>{{ $answers[$report->user_id][$headingTitle[$i]] }}</td>
                            @endfor
                            <td>{{ $report->total_per }}</td>
                            @if( $report->result == 0)
                              <td>{{ 'Fail' }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input id="result" type="hidden" name="result" value="{{$report->id}}"><br>
                                <input class="noExport test" id="Pass_{{$report->id}}" type="checkbox" value="{{$report->id}}" name="Pass"><span class="noExpo">Consider</span></td>
                            @elseif($report->result == 2)
                              <td class="considered">{{ 'Considered' }}</td>
                            @else
                              <td>{{'Pass'}}</td>
                            @endif
                            <!-- <td></td>
                            <td></td> -->
                            {{-- <td style="text-align:center"><a href="{{ url('user-view', $report->id)}}" title="View All Details" ><i class="fa fa-eye"></i></a>&nbsp;&nbsp; --}}
                           {{--  <a  style="margin-left:15px" class="delete_user" data-emp-id="{{$report->id}}" href="javascript:void(0)" title="Delete User"><i class="fa fa-trash"></i></a>   --}}
                            {{-- </td> --}}
                        </tr>
                        @endforeach
                        <?php
               //exit;
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
// $(function(){
//     $("#reports_tbl").dataTable();
//     // window.setTimeout(function() {
//     //     $("#flashdiv").hide();
//     // }, 4000);
// });
//     $('.delete_user').click(function (e) {
//         e.preventDefault();
//         var user_id = $(this).attr('data-emp-id');
//         var parent = $(this).parent("td").parent("tr");
//         bootbox.dialog({
//             message: "Are you sure you want to Delete ?",
//             title: "<i class='glyphicon glyphicon-trash'></i> Detestlete !",
//             buttons: {
//                 success: {
//                     label: "No",
//                     className: "btn-success",
//                     callback: function () {
//                         $('.bootbox').modal('hide');
//                     }
//                 },
//                 danger: {
//                     label: "Delete!",
//                     className: "btn-danger",
//                     callback: function () {
//                         $.ajax({
//                                 type: 'POST',
//                                 url: '{{ url("delete-report") }}',
//                                 data: {'_token':"{{ csrf_token() }}",'user_id':user_id}
//                             })
//                             .done(function (response) {
//                                 if(response == 'notloggedin'){
//                                     location.reload();
//                                 }
//                                 else{
//                                     bootbox.alert(response);
//                                 parent.fadeOut('slow');
//                                 }
//
//                             })
//                             .fail(function () {
//                                 bootbox.alert('Error....');
//                             })
//                     }
//                 }
//             }
//         });
//     });
//
//
// </script>
<script>
$(function(){
  $("#reports_tbl").dataTable({
    dom: 'Bfrtip',
		lengthChange: true,
		lengthMenu: [[20, 100, 50, -1], [20, 50, 100, "All"]],
		colReorder: true,
		buttons: [
			{
				extend: 'csv',
				footer:true,
//                exportOptions:{ columns: "tbody tr td:not(.considered)" },
				filename: $("#Name").val() ? $("#Name").val() : 'Reports',
				customize: function (csvz) {
					csvz = csvz;
					return csvz;
				}
			},
		],
    "columnDefs": [
    { "orderable": false, "targets": -1 }
  ]
  });
  });
    $(".test").on('click',function(e){

        var chckId = e.target.value;
        var parent = $(this).parent("td").parent("tr");
        bootbox.dialog({
            message: "Are you sure you want to Change result?",
            title: "<i class='glyphicon glyphicon-trash'></i> Update !",
            buttons: {
                danger: {
                    label: "No",
                    className: "btn-danger",
                    callback: function () {
                        $('.bootbox').modal('hide');
                        location.reload();
                    }
                },
                success: {
                    label: "Yes",
                    className: "btn-success",
                    callback: function () {
                        $.ajax({
                                type: 'POST',
                                url: '{{ url("update-results") }}',
                                data: {'_token':"{{ csrf_token() }}",'chckId':chckId}
                            })
                            .success(function (response) {
                              if(response == 'notloggedin'){
                                 location.reload();
                              }
                                else{
                                  bootbox.alert({
                                          message: response,
                                          callback: function () {
                                            // $("#reports_tbl").DataTable().ajax.reload();
                                             location.reload(true);
                                            }
                                        });
                                    // bootbox.alert(response);
                                    // location.reload();
                                    // parent.fadeOut('slow');
                                    // parent.reload();
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
