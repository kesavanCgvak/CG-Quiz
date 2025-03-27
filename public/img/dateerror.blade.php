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
                                    <h2 style="text-align:center;">
                                    	{{$error}}
                                    </h2>
                                                   
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