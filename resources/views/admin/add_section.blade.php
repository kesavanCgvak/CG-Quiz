@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Create Section</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('sections') }}">Sections</a></li>
                        <li>Create Sections</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
		    <div class="block">
		        <div class="block-title">
		            <h2>Section Form</h2>
		        </div>
				<?php //if(isset($errors))print_r($errors->all()); ?>
		        <form action="{{ url('add-section') }}" method="post" class="form-horizontal form-bordered">
					{{ csrf_field() }}
		            {{-- <div class="form-group">
		                <label class="col-md-3 control-label" for="section">Section <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <input type="text" id="section" name="section" class="form-control" value="{{ old('section') }}">
							@if ($errors->has('section'))
								<span class="error">{{ $errors->first('section') }}</span>
							@endif
		                </div>
		            </div> --}}
		            <div class="form-group">
		                <label class="col-md-3 control-label" for="section_name">Section Name <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <input type="text" id="section_name" name="section_name" class="form-control" value="{{ old('section_name') }}">
		                    @if ($errors->has('section_name'))
								<span class="error">{{ $errors->first('section_name') }}</span>
							@endif
		                </div>
		            </div>
					{{-- <div class="form-group">
		                <label class="col-md-3 control-label" for="pass_percentage">Pass Percentage <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <input type="text" id="pass_percentage" name="pass_percentage" class="form-control" value="{{ old('pass_percentage') }}"><span style="position: absolute;float: left;right: 0;top: 10px;">%</span>
							@if ($errors->has('pass_percentage'))
								<span class="error">{{ $errors->first('pass_percentage') }}</span>
							@endif
		                </div>
		            </div> --}}
					<div class="form-group">
		                <label class="col-md-3 control-label" for="sort_order">Sort Order</label>
		                <div class="col-md-1">
		                    <input type="text" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order') }}">
		                </div>
						<div class="col-md-12 col-md-offset-3">
							@if ($errors->has('sort_order'))
								<span class="error">{{ $errors->first('sort_order') }}</span>
							@endif
						</div>
		            </div>
					<div class="form-group">
		                <label class="col-md-3 control-label" for="is_active">Status</label>
		                <div class="col-md-6">
							<select id="is_active" name="is_active" class="form-control">
								<option value="Yes" {{ (old('is_active') == 'Yes') ? 'selected' : '' }}>Active</option>
								<option value="No" {{ (old('is_active') == 'No') ? 'selected' : '' }}>InActive</option>
							</select>
							@if ($errors->has('is_active'))
								<span class="error">{{ $errors->first('is_active') }}</span>
							@endif
		                </div>
		            </div>
		            <div class="form-group form-actions">
		                <div class="col-md-9 col-md-offset-3">
							<button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
		                    <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
		                    <a href="{{ url('sections') }}" class="btn btn-effect-ripple btn-warning">Cancel</a>
		                </div>
		            </div>
		        </form>
		    </div>
	    </div>
    </div>
</div>

@endsection
