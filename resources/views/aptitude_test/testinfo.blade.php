@extends('layouts.app_home')
@section('content')

<div id="page-content">
    <div class="main_page_content" id="main_page_content">
        <section class="satisfaction-form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="survey-questionnaire">
                            <div class="row">
                                <div class="col-sm-offset-2 col-md-8">
                                    <h1 class="common-primary-head">Welcome to Quiz</h1>
                                    <table class="table" id="info-tbl">
                                        <thead>
                                        <tr class="info">
                                            <th colspan="3" id="tblhead">Questions in this test span across three sections.</th>
                                        </tr>
                                        <tr class="info"> 
                                            <th>Section</th>
                                            <th>Section Name</th>
                                            <th>Pass percentage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sections as $section)
                                            <tr class="info">
                                                <td>Section {{ $section->section}}</td>
                                                <td>{{ $section->section_name}}</td>
                                                <td>{{ $section->pass_percentage}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <h3>       
                                        <a href="{{ url('instructions',base64_encode($campus->campus_id)) }}">
                                            Click here to read the test instructions
                                        </a>                                
                                        {{-- <form id="frm-surveyform" action="{{ route('general-instructions') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form> --}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>    
@endsection