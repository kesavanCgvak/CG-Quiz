@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Edit Level</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('level') }}">Level</a></li>
                        <li>Edit Level</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
		    <div class="block">
		        <div class="block-title">
		            <h2>Level Form</h2>
		        </div>
		        <form action="{{ url('edit-level/'.base64_encode($level_details->id)) }}" method="post" class="form-horizontal form-bordered">
					{{ csrf_field() }}
		            <div class="form-group">
		                <label class="col-md-3 control-label" for="level">Level <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <input type="text" id="level" name="level" class="form-control" value="{{ $level_details->level }}">
							@if ($errors->has('level'))
								<span class="error">{{ $errors->first('level') }}</span>
							@endif
		                </div>
		            </div>
		            <div class="form-group form-actions">
		                <div class="col-md-9 col-md-offset-3">
							<button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
		                    <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
		                    <a href="{{ url('level') }}" class="btn btn-effect-ripple btn-warning">Cancel</a>
		                </div>
		            </div>
		        </form>
		    </div>
	    </div>
    </div>
</div>

@endsection