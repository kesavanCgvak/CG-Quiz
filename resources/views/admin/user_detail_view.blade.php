@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Users Test Results</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('campus-reports') }}">Campus Reports</a></li>
                        <li><a href="{{ url('user-reports/'.base64_encode($results->campus_id)) }}">User Reports</a></li>
                        <li>Users Test Results</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="block full">
        <div class="block-title">
            <h2>Users Test Results</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" style="width:100%" id="reports_tbl">
                <thead>
                    <tr>
                        <th>Test Date</th>
                        <th>Reg.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Overall Percentage</th>
                        @foreach($answer as $key=>$value)
                        <th>{{$key}}</th>
                        @endforeach
                        {{-- <th>Quantitative Percentage</th>
                        <th>Verbal Percentage</th>
                        <th>Logical Percentage</th> --}}
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{ date('d/m/Y', strtotime($results->test_completed_date))}}</td>
                        <td>{{ $results->registration_number}}</td>
                        <td>{{ $results->name}}</td>
                        <td>{{ $results->email}}</td>
                        <td>{{ $results->total_per}}</td>
                        @foreach($answer as $key=>$value)
                        <td>{{$answer[$key]}}</td>
                        @endforeach
                        {{-- <td>{{ $results->quantitative_per}}</td>
                        <td>{{ $results->verbal_per}}</td>
                        <td>{{ $results->logical_per}}</td> --}}
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
