@extends('layouts.header')
@section('content')
{{-- @php
	echo phpinfo();
@endphp --}}
	  <div id="main-wrap">
            <!-- First Row -->
          <div class="row" style="background-color: #ebeef2;">
                <div class="col-sm-12 col-md-6 col-lg-4" style="margin-top:60px;position: relative;">
	                <a href="javascript:void(0)" class="widget">
	                    <div class="widget-content widget-content-mini text-right clearfix">
	                        <div class="widget-icon pull-left themed-background-success">
	                            <i class="fa fa-user fa-2x text-light-op"></i>
	                        </div>
	                        <h2 class="widget-heading h3 text-success">
	                            <strong> {{$users}}</strong>
	                        </h2>
	                        <span class="text-muted">USERS</span>
	                    </div>
	                </a>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-4" style="margin-top:60px;">
                    <a href="{{'campuses'}}" class="widget">
                        <div class="widget-content widget-content-mini text-right clearfix">
                            <div class="widget-icon pull-left themed-background-warning">
                                <i class="fa fa-book fa-2x text-light-op"></i>
                            </div>
                            <h2 class="widget-heading h3 text-warning">
                                <strong>{{$campus}}</strong>
                            </h2>
                            <span class="text-muted">ASSESSMENT</span>
                        </div>
                    </a>
                </div>
 				        <div class="col-sm-12 col-md-6 col-lg-4" style="margin-top:60px;">
                    <a href="{{'colleges'}}" class="widget">
                        <div class="widget-content widget-content-mini text-right clearfix">
                            <div class="widget-icon pull-left themed-background-danger">
                                <i class="fa fa-university fa-2x text-light-op"></i>
                            </div>
                            <h2 class="widget-heading h3 text-danger">
                                <strong>{{$college}}</strong>
                            </h2>
                            <span class="text-muted">COMPANY</span>
                        </div>
                    </a>
                </div>
          </div>

        {{-- For chart --}}

            <div class="row">
	            <div class="col-md-12">
	              <div class="panel panel-default">
	                <div class="panel-heading"><b></b></div>
	                  <div class="panel-body">
	                    <canvas style="background-color: #fff;" id="canvas" height="280" width="600"></canvas>
	                  </div>
	              </div>
	            </div>
     	      </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<script>
        var campus = new Array();
        var users = new Array();
        @forelse($user as $use)
    	users.push("{{$use->total_users}}");
    	campus.push("{{$use->campus_name}}");
    	@empty
   		@endforelse
        $(document).ready(function(){
            var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels:campus,
                      datasets: [{
                          label:'users',
                          data: users,
                           backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(75, 192, 192, 0.2)',
			                'rgba(153, 102, 255, 0.2)',
			                'rgba(255, 159, 64, 0.2)'
			           		 ],
				            borderColor: [
				                'rgba(255,99,132,1)',
				                'rgba(54, 162, 235, 1)',
				                'rgba(255, 206, 86, 1)',
				                'rgba(75, 192, 192, 1)',
				                'rgba(153, 102, 255, 1)',
				                'rgba(255, 159, 64, 1)'
				            ],
                          borderWidth: 1,
                      }]
                  },
                  options: {
                      scales: {
                          xAxes: [{
                             scaleLabel: {
											        display: true,
											        labelString: 'Campus'
											      }
                          }],
                          yAxes: [{
                             scaleLabel: {
											        display: true,
											        labelString: 'Users'
											      }
                          }]
                      }
                  }
              });
          });
</script>

@endsection
