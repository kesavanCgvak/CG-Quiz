@extends('layouts.header')
@section('content')

<div id="page-content">
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Edit Company</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('colleges') }}">Company</a></li>
                        <li>Edit Company</li>
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
		        <form action="{{ url('edit-college/'.base64_encode($college_details->id)) }}" id="add_college" method="post" class="form-horizontal form-bordered">
					{{ csrf_field() }}
		            <div class="form-group">
		                <label class="col-md-3 control-label" for="college_name">Company Name <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <input type="text" id="college_name" name="college_name" class="form-control" value="{{ $college_details->college_name }}">
          							@if ($errors->has('college_name'))
          								<span class="error">{{ $errors->first('college_name') }}</span>
          							@endif
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-md-3 control-label" for="college_address">Company Address <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <textarea type="text" id="college_address" name="college_address" class="form-control" value="">{{  $college_details->college_address }}</textarea>
		                    @if ($errors->has('college_address'))
          								<span class="error">{{ $errors->first('college_address') }}</span>
          							@endif
		                </div>
		            </div>
                <div class="form-group">
		                <label class="col-md-3 control-label" for="placement_officer_name">Contact Name <span class="required_class">*</span></label>
		                <div class="col-md-6">
		                    <input type="text" id="placement_officer_name" name="placement_officer_name" class="form-control" value="{{ $college_details->placement_officer_name }}">
          							@if ($errors->has('placement_officer_name'))
          								<span class="error">{{ $errors->first('placement_officer_name') }}</span>
          							@endif
		                </div>
		            </div>
                <div class="form-group">
		                <label class="col-md-3 control-label" for="contact_email">Contact Email<span class="required_class">*</span></label>
		                <div class="col-md-6">
                      @php
                        $i = 0;
                      @endphp
                      <div class="row input_fields_wrap">
                        <div class="col-md-6">
                          @foreach ($contact_email as $key => $value)
    		                    <input type="email" name="contact_email[@php echo $i @endphp]" class="form-control" value="{{ $value }}" required><br>
              							@if ($errors->has('contact_email[@php  echo $i @endphp]'))
              								<span class="error">{{ $errors->first('contact_email[@php echo $i  @endphp]') }}</span>
              							@endif
                            @php
                              $i++;
                            @endphp
                          @endforeach
                      </div>
                      <div class="col-md-2">
                        <button class="add_field_button btn btn-success"><i class="fa fa-plus"></i></button>
                      </div><br><br>
		                </div>
		            </div>
              </div>
              <div class="form-group">
		                <label class="col-md-3 control-label" for="phone_number">Phone Number<span class="required_class">*</span></label>
		             <div class="col-md-6">
                      @php
                        $j = 0;
                      @endphp
                      <div class="row input_fields_wraps">
                        <div class="col-md-6">
                          @foreach ($phone_number as $key => $value)
    		                    <input type="text" name="phone_number[@php echo $j @endphp]" class="form-control" value="{{ $value }}" required><br>
              							@if ($errors->has('phone_number[@php echo $j @endphp]'))
              								<span class="error">{{ $errors->first('phone_number[@php echo $j @endphp]') }}</span>
              							@endif
                            @php
                              $j++;
                            @endphp
                          @endforeach
                       </div>
                       <div class="col-md-2">
                         <button class="add_field_buttons btn btn-success"><i class="fa fa-plus"></i></button>
                       </div><br><br>
		                </div>
		            </div>
              </div>
					      <div class="form-group">
		                <label class="col-md-3 control-label" for="is_active">Status</label>
		                <div class="col-md-6">
        							<select id="is_active" name="is_active" class="form-control">
        								<option value="Yes" {{ ($college_details->is_active == 'Yes') ? 'selected' : '' }}>Active</option>
        								<option value="No" {{ ($college_details->is_active == 'No') ? 'selected' : '' }}>InActive</option>
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
		                    <a href="{{ url('colleges') }}" class="btn btn-effect-ripple btn-warning">Cancel</a>
		                </div>
		            </div>
		        </form>
		    </div>
	    </div>
    </div>
</div>
<script>

  // disable and enable submit button
//   $(document).ready(function() {
//      $(':input[type="submit"]').prop('disabled', true);
//      $('.form-control').keyup(function() {
//         if($(this).val() != '') {
//            $(':input[type="submit"]').prop('disabled', false);
//         }
//      });
//  });
$(document).ready(function() {
  var max_fields      = 2; //maximum input boxes allowed
  var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  var x = 1; //initlal text box count
  var i = "<?php echo $i++;?>";
  // alert(old);
  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed

      $(wrapper).append('<div style="width:45%;margin-left:15px;" ><input type="email  " class="col-md-offset-0 form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="contact_email['+i+']" required/><i class="remove_field  btn btn-danger fa fa-times"></i></div>'); //add input box
      x++; //text box increment
    }
  });

  $(wrapper).on("click",".remove_field", function(e){
    //user click on remove text
    e.preventDefault();
    $(this).parent('div').remove(); x--;
  })
});

// For adding Phone number
$(document).ready(function() {
	var maxs_fields      = 2; //maximum input boxes allowed
	var wrappers   		= $(".input_fields_wraps"); //Fields wrapper
	var add_buttons      = $(".add_field_buttons"); //Add button ID
  var pattern = new RegExp(/^\+?\d{10,13}/);
  var j = "<?php echo $j++;?>";
	var y = 1; //initlal text box count
	$(add_buttons).click(function(e){ //on add input button click
		e.preventDefault();
		if(y < maxs_fields){ //max input box allowed
			 //text box increment
			$(wrappers).append('<div style="width:45%;margin-left:15px;"><input type="text" class="form-control" name="phone_number['+j+']"  pattern="'+pattern+'" required/><i class="remove_field  btn btn-danger fa fa-times"></i></div>'); //add input box
      y++;
		}
	});

	$(wrappers).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault();
    $(this).parent('div').remove(); y--;
	})
});

</script>


{{-- Validation --}}
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
