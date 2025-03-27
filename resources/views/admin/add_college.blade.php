@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Create Company</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('colleges') }}">Company</a></li>
                        <li>Create Company</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
		    <div class="block">
		        <div class="block-title">
		            <h2>Company Form</h2>
		        </div>
		        <form action="{{ url('add-college') }}" method="post" class="form-horizontal form-bordered" id="add_college">
					{{ csrf_field() }}
		            <div class="form-group">
		                <label class="col-md-3 control-label" for="college_name">Company Name <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <input type="text" id="college_name" name="college_name" class="form-control" value="{{ old('college_name') }}">
							@if ($errors->has('college_name'))
								<span class="error">{{ $errors->first('college_name') }}</span>
							@endif
		                </div>
		            </div>
                    {{-- <div class="form-group">
		                <label class="col-md-3 control-label" for="college_info">Company Info <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <input type="text" id="college_info" name="college_info" class="form-control" value="{{ old('college_info') }}">
							@if ($errors->has('college_info'))
								<span class="error">{{ $errors->first('college_info') }}</span>
							@endif
		                </div>
		            </div> --}}
                <div class="form-group">
                <label class="col-md-3 control-label" for="college_address">Company Address <span class="required_class">*</span></label>
                <div class="col-md-6">
                    <textarea rows="5" id="college_address" name="college_address" class="form-control">{{ old('college_address') }}</textarea>
                    @if ($errors->has('college_address'))
                      <span class="error">{{ $errors->first('college_address') }}</span>
                    @endif
                </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="placement_officer_name">Contact Name <span class="required_class">*</span></label>
                  <div class="col-md-6">
                      <input type="text" id="placement_officer_name" name="placement_officer_name" class="form-control" value="{{ old('placement_officer_name') }}" >
                      @if ($errors->has('placement_officer_name'))
                        <span class="error">{{ $errors->first('placement_officer_name') }}</span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="placement_officer_name">Contact Email <span class="required_class">*</span></label>
                    <div class="row input_fields_wrap">
                      <div class="col-md-4">
                        <input type="email" name="contact_email[0]" class="form-control contact_email"  value="{{old('contact_email.0') }}" required>
                        @if ($errors->has('contact_email[0]'))
                          <span class="error">{{ $errors->first('contact_email[0]') }}</span>
                        @endif
                      </div>
                      <div class="col-md-2">
                        <button class="add_field_button btn btn-success"><i class="fa fa-plus"></i></button>
                      </div><br><br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="placement_officer_name">Phone Number <span class="required_class">*</span></label>
                    <div class="row input_fields_wraps">
                      <div class="col-md-4 ">
                        <input type="text" name="phone_number[0]" class="form-control phone_number" pattern="^\+?\d{10,13}" value="{{old('phone_number.0') }}" required>
                        @if ($errors->has('phone_number[0]'))
                          <span class="error">{{ $errors->first('phone_number[0]') }}</span>
                        @endif
                      </div>
                      <div class="col-md-2">
                        <button class="add_field_buttons btn btn-success"><i class="fa fa-plus"></i></button>
                      </div><br><br>
                    </div>
                </div>
                <div class="form-group">
		              <label class="col-md-3 control-label" for="status">Company Status</label>
		              <div class="col-md-6">
                        <select id="status" name="status" class="form-control" value="{{ old('status') }}">
                            <option value="Yes"> Active </option>
                            <option value="No"> InActive </option>
                        </select>
              					@if ($errors->has('status'))
              						<span class="error">{{ $errors->first('status') }}</span>
              					@endif
		              </div>
		            </div>
		            <div class="form-group form-actions">
		                <div class="col-md-9 col-md-offset-3">
							          <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
		                    <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
		                    <a href="{{ url('colleges') }}" class="btn btn-effect-ripple btn-warning">Cancel</a>
		                </div>
		            </div>
		        </form>
		    </div>
	    </div>
    </div>
</div>
<script>

// For adding contact email
$(document).ready(function() {
	var max_fields      = 3; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
  var x = 1; //initlal text box count
  // alert(old);
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed

			$(wrapper).append('<div class="form-group"><label class="col-md-3" style="visibility:hidden;"></label><div class="col-md-4"><input type="email" class="form-control"  name="contact_email['+x+']" required/><i class="remove_field  btn btn-danger fa fa-times"></i></div></div>'); //add input box
      x++; //text box increment
		}
	});

	$(wrapper).on("click",".remove_field", function(e){
    //user click on remove text
		e.preventDefault();
    $(this).parent().parent('div').remove(); x--;
	})
});

// For adding Phone number
$(document).ready(function() {
	var maxs_fields      = 3; //maximum input boxes allowed
	var wrappers   		= $(".input_fields_wraps"); //Fields wrapper
	var add_buttons      = $(".add_field_buttons"); //Add button ID
  var pattern = new RegExp(/^\+?\d{10,13}$/);
	var y = 1; //initlal text box count
	$(add_buttons).click(function(e){ //on add input button click
		e.preventDefault();
		if(y < maxs_fields){ //max input box allowed
			 //text box increment
			$(wrappers).append('<div class="form-group"><label class="col-md-3" style="visibility:hidden;"></label><div class="col-md-4"><input type="text" class="form-control" name="phone_number['+y+']"  pattern="'+pattern+'" required/><i class="remove_field  btn btn-danger fa fa-times"></i></div></div>'); //add input box
      y++;
		}
	});

	$(wrappers).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault();
    $(this).parent().parent('div').remove(); y--;
	})
});

</script>
<script>
$(document).ready(function () {
$('#add_college').validate({ // initialize the plugin
  rules: {
      college_name: {
          required: true
      },
      college_address: {
          required: true,
      },
      placement_officer_name: {
          required: true
      },
  },
});
});

</script>
@endsection
