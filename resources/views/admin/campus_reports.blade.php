@extends('layouts.header')
@section('content')
    <style>
        #reports_tbl_length:nth-child(2) {
            display: none;
        }

        #reports_tbl_filter:nth-child(3) {
            display: none;
        }
    </style>
    <div id="page-content">
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Assessment Reports</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li>Assessment Reports</li>
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
                <h2>Assessment Reports</h2>

                {{-- <div class="pull-right">
                    <a href="add-college" class="btn btn-effect-ripple btn-primary" style="float: right;">Add</a>
                </div> --}}
            </div>
            <div class="table-responsive">
                <div class="col-sm-3 row">
                    <select name="" id="college" class="form-control input-md col-sm-2" aria-controls="reports_tbl">
                        <option value="">Select Company</option>
                        @foreach($college as $coll)Show ￼ entries
                        <option value="{{$coll->college_name}}">{{$coll->college_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-offset-1 col-sm-3 row">
                    <select name="" id="campus" class="form-control input-md col-sm-2" aria-controls="reports_tbl">
                        <option value="">Select Assessment</option>
                        @foreach($campus as $camp)
                            <option value="{{$camp->campus_name}}">{{$camp->campus_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-offset-1 col-sm-3 row">
                    <select name="" id="date" class="form-control input-md col-sm-2" aria-controls="reports_tbl">
                        <option value="">Select Year</option>
                        @foreach($dates as $date)
                            <option value="{{ $date->year }}">{{ $date->year}}</option>
                        @endforeach
                    </select>
                </div>
                <br><br><br>
                <div class="col-md-6">
                    <div class="col-md-4">
                        <label for="campus_count">Total Assessment:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control input-sm" id="total_campus" name="123"
                               value="{{$campus_count}}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-4">
                        <label for="user_count">Total Candidates :</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control input-sm" id="total_user" name="123"
                               value="{{$user_count}}" readonly>
                    </div>
                </div>
                <div id="reports_tbl1">
                    <table class="table table-bordered table-hover" style="width:100%" id="reports_tbl">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Company Name</th>
                            <th>Assessment Name</th>
                            <th>Assessment Date</th>
                            {{-- <th>Total Candidates Attended the Group Discussion </th>
                            <th>Total Candidates Shortlisted Group Discussion </th> --}}
                            <th>Total Candidates Attended the Assessment</th>
                            <!-- <th>Group Discussion Attendees</th> -->
                            <!-- <th>Total Candidates</th> -->
                            <th>Selected</th>
                            <th>Rejected</th>
                            <th>Considered</th>
                            <th class="noExport">View</th>
                        </tr>
                        </thead>
                        <tbody>  <?php
                        //echo '<pre>';print_r($pass);
                        //print_r($fail);
                        //exit;
                        ?>
                        @foreach($reports as $key => $campus)
                            <?php
                            $pass_count = 0;
                            foreach ($pass as $pas) {
                                if ($pas->campus_id == $campus->campus_id) {
                                    $pass_count = $pas->passcount;
                                }

                            }
                            $fail_count = 0;
                            foreach ($fail as $fai) {
                                if ($fai->campus_id == $campus->campus_id) {
                                    $fail_count = $fai->failcount;
                                }

                            }
                            $considered_count = 0;
                            foreach ($considered as $consider) {
                                if ($consider->campus_id == $campus->campus_id) {
                                    $considered_count = $consider->considered;
                                }
                            }
                            ?>

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $campus->college_name}}</td>
                                <td>{{ $campus->campus_name }}</td>
                                <td>{{ date('d/m/Y', strtotime($campus->campus_date))}}</td>
                                {{-- <td>{{ $campus->gd_candidates }}</td>
                                <td>{{ $campus->gd_sorted_candidates }}</td> --}}
                                <td>{{ $campus->total_users}}</td>
                                <td>{{ $pass_count }}</td>
                                <td>{{ $fail_count }}</td>
                                <td>{{ $considered_count }}</td>
                                <td style="text-align:center"><a
                                            href="{{ url('user-reports', base64_encode($campus->campus_id))}}"
                                            title="View All Details"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                    {{-- <a  style="margin-left:15px" class="delete_campus" data-emp-id="{{$campus->id}}" href="javascript:void(0)" title="Delete User"><i class="fa fa-trash"></i></a>   --}}
                                </td>
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
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#reports_tbl').DataTable({
                dom: 'Bfrtip',
                lengthChange: true,
                lengthMenu: [[20, 100, 50, -1], [20, 50, 100, "All"]],
                colReorder: true,
                buttons: [
                    {
                        extend: 'csv',
                        footer: true,
                        exportOptions: {columns: "thead th:not(.noExport)"},
                        filename: $("#Name").val() ? $("#Name").val() : 'Reports',
                        customize: function (csvz) {
                            csvz = 'Total Assessment = ' + $('#total_campus').val() + ',\b' + 'Total Candidates = ' + $('#total_user').val() + ",\n" + ",\n" + csvz + ",\n";
                            return csvz;
                        }
                    },
                ],

                "columnDefs": [
                    {"orderable": false, "targets": -1}
                ]
            });

            var oTable = $('#reports_tbl').dataTable();
            // Filter by college
            $('#college').on('change', function () {
                oTable.fnFilter(this.value, 1);
                //table.search(this.value).draw();
            });
            // Filter by campus
            $('#campus').on('change', function () {
                //table.search(this.value).draw();
                oTable.fnFilter(this.value, 2);
            });
            // Filter by date
            $('#date').on('change', function () {
                oTable.fnFilter(this.value, 3);
                //table.search(this.value).draw();
            });

        });

        // $('#campus').on('change', function(){
        //    table.search(this.value).draw();
        // });
        // $('#college').on('change', function(){
        //    table.search(this.value).draw();
        // });
        // $('.delete_campus').click(function (e) {
        //     e.preventDefault();
        //     var user_id = $(this).attr('data-emp-id');
        //     var parent = $(this).parent("td").parent("tr");
        //     bootbox.dialog({
        //         message: "Are you sure you want to Delete ?",
        //         title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
        //         buttons: {
        //             success: {
        //                 label: "No",
        //                 className: "btn-success",
        //                 callback: function () {
        //                     $('.bootbox').modal('hide');
        //                 }
        //             },
        //             danger: {
        //                 label: "Delete!",
        //                 className: "btn-danger",
        //                 callback: function () {
        //                     $.ajax({
        //                             type: 'POST',
        //                             url: '{{ url("delete-campusreport") }}',
        //                             data: {'_token':"{{ csrf_token() }}",'campus_id':campus_id}
        //                         })
        //                         .done(function (response) {
        //                             if(response == 'notloggedin'){
        //                                 location.reload();
        //                             }
        //                             else{
        //                                 bootbox.alert(response);
        //                             parent.fadeOut('slow');
        //                             }
        //
        //                         })
        //                         .fail(function () {
        //                             bootbox.alert('Error....');
        //                         })
        //                 }
        //             }
        //         }
        //     });
        // });
    </script>


@endsection
