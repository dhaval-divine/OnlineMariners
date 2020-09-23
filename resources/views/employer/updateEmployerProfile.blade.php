@extends('layouts.app_afterLogin')

@section('content')

<?php 
// echo "<pre>";
// echo 'Req: '.request()->is('employer/edit');
// print_r($employerData);
// exit;
?>
<!-- post a job -->
<section class="dashboard-wrap">
				<div class="container-fluid">
					<div class="row">
					
						<!-- Sidebar Wrap -->
						<div class="col-lg-3 col-md-4">
							<div class="side-dashboard">
								
								<div class="dashboard-avatar">
									
									<div class="dashboard-avatar-thumb">
									<?php 
	                                    $filename = $empImg[0]->pic_path;
	                                    $url = url('/public/empProfile/'.$filename); 
                                	?>
                                	@if(isset($empImg))
                            		<img src="{{ $url }}" class="img-avater" alt="emp-pic" />
                                	@else
                                    <img src="public/empProfile/emp-default.png" class="img-avater" alt="employer-profile-image" />
                                	@endif
									</div>
									<form class="post-form"  method="POST" action="{{ route('employer.store') }}" enctype="multipart/form-data">
									@csrf
									<div class="col-md-12 col-sm-12">
		                                <div class="form-group">
		                                    <span class="control-fileupload">
		                                    <label for="file">Update Profile Image</label>
		                                    <input type="file" name="employer_pic" id="employer_pic">
		                                    </span>
		                                </div>
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
								<!-- Flash Msg on success-->
		                        @if( session('success') )
                                    <div class="msg alert alert-success alert-dismissable fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <b>Success ! </b>{{ session('success') }}
                                    </div>
                                @endif		                        
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
										<h4><i class="ti-ruler-pencil"></i>Post New Page</h4>
									</div>
									
									<div class="dashboard-caption-wrap">
										
											
											<!--Company-name email -->
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Company Name*:</label>
														<input type="text" name="company_name" class="form-control" placeholder="Abc PVT LTD" value="{{ $employerData->company_name }}" required>
													</div>	
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Email *:</label>
														<?php $email = Session::get('employerEmail');?>
														<input type="email" name="email" class="form-control" placeholder="" value="<?php echo (isset($email)) ?  trim($email) : ''; ?>" disabled>
													</div>	
												</div>
											</div>																		
											
											<!--contactperson mobile -->
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Contact person Name*:</label>
														<input type="text" name="contact_person" class="form-control" placeholder="Contact person" value="{{ $employerData->contact_person }}" required>
													</div>	
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Mobile Number*:</label>
														<input type="number" name="mobile_number" class="form-control" placeholder="Mobile Number" value="{{ $employerData->mobile_number }}" required>
													</div>	
												</div>
											</div>																	
											
											<!-- Lat Long -->
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<input type="hidden" id="lat" name="lat" class="form-control" value='' disabled>
													</div>	
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="form-group">
														<input type="hidden" id="long" name="long" class="form-control" value='' disabled>
													</div>	
												</div>
											</div>
											
											<div class="row">												
												<div class="col-lg-12 col-md-12 col-sm-6">
													<label>Company Logo*:</label>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
			                                		<div class="form-group">
			                                    		<span class="control-fileupload">
			                                    		<label for="file">Company Logo*</label>
			                                    		<input type="file" name="company_logo" id="company_logo" value="{{$employerData->company_logo}}">
			                                    		</span>
			                                		</div>

		                                		</div>
		                                		<?php
		                                			$file = $employerData->company_logo;
		                                			$url = url('public/companyLogo/'.$file);
		                                		?>
		                                		<div class="col-lg-6 col-md-6 col-sm-6">
		                                			<div class="form-group">
		                                				<label for="file">Past Logo</label>
		                                			</div>
		                                			@if(isset($file))
                            							<img src="{{ $url }}" class="company logo" alt="company-logo" width="150" height="150" />
                                					@endif
		                                		</div>
			                            	</div>

											
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="form-group">
														<label>Address*</label>
														<input type="text" id="my-address" name="address" class="form-control" placeholder="Ex. 502, Sector 20 C, Mohali India" value="{{ $employerData->address }}" required>
													</div>	
												</div>

												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="form-group">
														<!-- <label>City</label> -->
														<input type="hidden" id="city" name="city" class="form-control" placeholder="City" value="{{ $employerData->city }}">
													</div>	
												</div>
												
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="form-group">
														<!-- <label>State</label> -->
														<input type="hidden" id="state" name="state" class="form-control" placeholder="State" value="{{ $employerData->state }}">
													</div>	
												</div>
												
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="form-group">
														<!-- <label>Country</label> -->
														<input type="hidden" id="country" name="country" class="form-control" placeholder="Country" value="{{ $employerData->country }}">
													</div>	
												</div>
											
											</div>
											<!-- Map -->
											<div class="row" style="display: none;">
												
												<div class="col-lg-12 col-md-12 col-sm-12" >
													<div class="form-group">
														<div id="map" style="width: 1070px; height:400px;"></div>
													</div>	
												</div>
											</div>															
											<!-- Submit  -->
											<div class="row mrg-top-30">
												<div class="col-md-12 col-sm-12">
													<div class="form-group text-center">
														<button type="submit" class="btn-savepreview"><i class="ti-angle-double-right"></i>Publish & Preview</button>
													</div>	
												</div>
											</div>

											
										</form>
									</div>
									
								</div>
							</div>
						</div>
					
					</div>
				</div>
			</section>
@endsection
@section('datepicker')
<script>
    $('#app_deadline').dateDropper();  
   
    //company logo
    $(function() {
      $('input[type=file]').change(function(){
        var t = $(this).val();
        var labelText = 'File : ' + t.substr(12, t.length);
        $(this).prev('label').text(labelText);
      })
    });
</script>

@endsection