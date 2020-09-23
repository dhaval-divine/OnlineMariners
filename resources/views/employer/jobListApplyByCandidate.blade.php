@extends('layouts.app_afterLogin')

@section('content')
<?php
	// echo "<pre>";
	// print_r($joblist);	
	// exit;
?>
<style type="text/css">
	.lblpad{
		/*padding: 25%; */
		vertical-align:bottom;
	}
</style>
<!-- post a job -->
<section class="dashboard-wrap">
				<div class="container-fluid">
					<div class="row">
					
						<!-- Sidebar Wrap -->
						<div class="col-lg-3 col-md-4">
							<div class="side-dashboard">
								<div class="dashboard-avatar">
									<?php 
	                                    $filename = $empImg[0]->pic_path;
	                                    $url = url('/public/empProfile/'.$filename); 
                                	?>
									<div class="dashboard-avatar-thumb">
									@if(isset($empImg))
                                    <img src="{{ $url }}" class="img-avater" alt="emp-pic" />
                                	@else
                                    <img src="public/empProfile/emp-default.png" class="img-avater" alt="employer-profile-image" />
                                	@endif
									</div>
									
									<div class="dashboard-avatar-text">
										<h4>{{ Session::get('employerName') }}</h4>
									</div>
									
								</div>
								
								<div class="dashboard-menu">
									<!-- include from includes layouts-->
									<ul>
			                            <li class="<?php echo(request()->is('employer/dashboard')) ? 'active':'' ?>">
			                                <a href="{{ route('employer.dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a>
			                            </li>
			                            <li class="<?php echo(request()->is('employer/profile')) ? 'active':'' ?>">
			                                <a href="{{ route('employer.profile') }}"><i class="ti-briefcase"></i>Create or Update Profile</a>
			                            </li>
			                            <!-- <li class="<?php //echo(request()->is('employer/edit')) ? 'active':'' ?>">
			                                <a href="{{-- route('employer.edit') --}}"><i class="ti-briefcase"></i>Update Profile</a>
			                            </li> -->
			                            @if(isset($empImg[0]->profile_status) && ($empImg[0]->profile_status == 1))
			                            <li class="<?php echo(request()->is('employer/postajob')) ? 'active':'' ?>">
			                                <a href="{{ route('postjob.index') }}"><i class="ti-ruler-pencil"></i>Post New Job</a>
			                            </li>
			                            <li class="<?php echo(request()->is('employer/postajob/listing')) ? 'active':'' ?>">
			                                <a href="{{ route('postjob.listing') }}"><i class="ti-user"></i>Post Job Listing And Update</a>
			                            </li>    
			                            <li class="<?php echo(request()->is('employer/application/listing')) ? 'active':'' ?>">
			                                <a href="{{ route('lists.appliedjob') }}"><i class="ti-user"></i>Candidate Job Applied List</a>
			                            </li>
			                            @endif
			                            <!--
			                            <li><a href=""><i class="ti-user"></i>Applications</a></li>
			                            <li><a href=""><i class="ti-wallet"></i>Packages</a></li>
			                            <li><a href=""><i class="ti-cup"></i>Choose Packages</a></li>
			                            <li><a href=""><i class="ti-flag-alt-2"></i>Viewed Resume</a></li>
			                            <li><a href=""><i class="ti-id-badge"></i>Edit Profile</a></li>
			                            <li><a href=""><i class="ti-power-off"></i>Logout</a></li>
			                            <!-- <li class="{{-- (request()->is('admin/cities')) ? 'active' : '' --}}">   -->
			                        </ul>
								</div>
							</div>
						</div>
						
						<!-- Content Wrap -->
						<div class="col-lg-9 col-md-8">
							<div class="dashboard-body">
								@if( session('success') )
		                            <div class="msg alert alert-success alert-dismissable fade in">
		                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                                <b>Success ! </b>{{ session('success') }}
		                            </div>
		                        @endif
		                        <!-- Flash Msg on success-->
		                        @if( session('error') )
		                            <div class="msg alert alert-danger alert-dismissable fade in">
		                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                                <b>Error ! </b>{{ session('error') }}
		                            </div>
		                        @endif
		                        @if( count($errors) > 0 )
		                            <div class="msg alert alert-danger alert-dismissable fade in">
		                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                                <ul>
		                                     @foreach ($errors->all() as $error)
		                                         <li style="text-transform: capitalize;">{{ $error }}</li>
		                                     @endforeach
		                                </ul>
		                            </div>
		                        @endif
								<div class="dashboard-caption">
									
									<div class="dashboard-caption-header">
										<h4><i class="ti-ruler-pencil"></i>Candidate List Who Apply For Job</h4>
									</div>
									
									<div class="dashboard-caption-wrap">
									@if($joblist)
									<table id="postjob_listing" class="display" style="width:100%">
								        <thead>
								            <tr>
								                <th>Job Title</th>
								                <th>Candidate Name</th>
								                <th>Experience</th>
								                <th>Contact No</th>
								                <th>Rank Position</th>
								                <th>Available From</th>
								                <th>Status</th>
								                <th>Action</th>
								                <th>Profile</th>
								            </tr>
								        </thead>
								        <tbody>
								        	@foreach($joblist as $job)
								            <tr>
								                <td>{{ mb_strimwidth($job->job_title, 0, 10, "...") }}</td>
								                <td style="text-transform: capitalize;">{{ $job->candidate_name }}</td>	        
								                <td>{{ $job->experience_years.' Years '.$job->experience_months.' Months'  }}</td>							              
								                <td>{{ mb_strimwidth($job->phone_number, 0, 10, "...") }}</td>
								                <td>{{ mb_strimwidth($job->rank_position , 0, 10, "...") }}</td>
								                <td>{{ date('m-d-Y', strtotime($job->availablefrom)) }}</td>
								                <td>
								                								                		
						                			
							                		<div class="{{ 'old_status_'.$job->id}}">
							                			@if($job->apply_status == 2)
									                	<label class="label label-info lblpad">Shortlisted</label>
									                	@elseif($job->apply_status == 3)
									                	<label class="label label-warning lblpad">Call For Interview</label>
									                	@elseif($job->apply_status == 4)
									                	<label class="label label-primary lblpad">Under Review</label>
									                	@elseif($job->apply_status == 0)
									                	<label class="label label-default lblpad">Pending</label>
									                	@elseif($job->apply_status == 1)
									                	<label class="label label-success lblpad">Selected</label>	               
									                	@elseif($job->apply_status == 5)
									                	<label class="label label-danger lblpad">Rejected</label>
									                	@endif
								                	</div>
								                	<div style="">
									                	<label id="<?php echo 'current_status_'.$job->id ?>" class="">
						                				</label>
								                	</div>

								                </td>
								                <td>
								                	<form class="form-horizontal" method="post" action="">
								                		{{ csrf_field() }}
								                		<input type="hidden" name="job_apply_id" id="job_apply_id" class="job_apply_id" value="{{ $job->id }}" class="">
								                		<select name="apply_status" data-id="<?php echo $job->id ?>" id="<?php echo $job->id ?>" class="apply_status form-control">
														  <option value="">Select action</option>
														  <option value="2">Shortlist</option>
														  <option value="3">Called For Interview</option>
														  <option value="4">Under Review</option>
														  <option value="1">Selected</option>
														  <option value="5">Reject</option>
														</select>                                      
	                                                <!-- <input type="hidden" name="_method" value="DELETE">
	                                                <button type="submit" onclick="return confirm('Are You Sure ?');" class="btn btn-danger btn-xs"><i class='fa fa-trash'></i></button> -->
	                                            </form>

								                </td>
								                <td><a href="{{ route('cand.details', $job->candidate_id) }}" class="btn btn-warning btn-xs" style="vertical-align: text-bottom;"><i class="fa fa-eye"></i></a></td>
								            </tr>
								            @endforeach
							            </tbody>
							            <tfoot>
								            <tr>
								                <th>Job Title</th>
								                <th>Candidate Name</th>
								                <th>Experience</th>
								                <th>Contact No</th>
								                <th>Rank Position</th>
								                <th>Available From</th>
								                <th>Status</th>
								                <th>Action</th>
								                <th>Profile</th>
								            </tr>
								        </tfoot>
						            </table>
						            @endif
								</div>
							</div>
						</div>
					
					</div>
				</div>
			</section>
@endsection
@section('datepicker')
<script>
	$(document).ready(function () {
	    $('#postjob_listing').DataTable();
	    // $('#current_status').hide();

	    $('.apply_status').change(function() {
	    	// var id = 	    	    	
	    	// var job_apply_id = $('.apply_status').attr('id');
	    	var apply_status = $(this).val();
	    	var job_apply_id = $(this).data('id');

	    	
	    	// alert('job_apply_id : '+ job_apply_id+ ' '+ apply_status);
	    	// return false;
	        $.ajaxSetup({
			    headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

	        $.ajax({
	            type: "POST",
	            dataType: "json",
	            url: "{{ route('change.applicationStatus') }}",
	            data: {'apply_status': apply_status, 'job_apply_id': job_apply_id},
	            success: function(data){
	    

            		$(".old_status_"+job_apply_id).hide();            		
            		$("#current_status_"+job_apply_id).removeAttr("class");
            		
            		if(data == 1){
            			$("#current_status_"+job_apply_id).addClass("label label-success");
            			$("#current_status_"+job_apply_id).text("Selected");            			
            		}else if(data == 2){
            			$("#current_status_"+job_apply_id).addClass("label label-info");
            			$("#current_status_"+job_apply_id).text("Shotlisted");
            		}else if(data == 3){
            			$("#current_status_"+job_apply_id).addClass("label label-warning");
            			$("#current_status_"+job_apply_id).text("Call For Interview");
            		}else if(data == 4){
            			$("#current_status_"+job_apply_id).addClass("label label-primary");
            			$("#current_status_"+job_apply_id).text("Under review");
            		}else if(data == 5){
            			$("#current_status_"+job_apply_id).addClass("label label-danger");
            			$("#current_status_"+job_apply_id).text("Rejected");
            		}

	            }
	        });
	    });

    });    
</script>

@endsection