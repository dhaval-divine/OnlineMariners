@extends('layouts.app_afterLogin')
<?php 
	// echo '<pre>';
	// print_r($empImg)

?>
@section('content')
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
										<h4><i class="ti-ruler-pencil"></i>Post New Page</h4>
									</div>
									
									<div class="dashboard-caption-wrap">
										<form class="post-form"  method="POST" action="{{ route('postjob.store') }}" enctype="multipart/form-data">
											@csrf
											<!-- JOb Title -->
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<div class="form-group">
														<label>Job Title*</label>
														<input type="text" name="job_title" class="form-control" placeholder="Enter Title" value="{{ old('job_title') }}" required>
													</div>	
												</div>
											</div>
											
											<!-- JOb Description -->
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<div class="form-group">
														<label>Job Description</label>
														<!-- <textarea name="job_description" class="form-control about height-120"  required>
														</textarea> -->
														<textarea name="job_description" id="job_discription">
															{{ old('job_description') }}
														</textarea>
													</div>
												</div>
											</div>

											<!-- Banner Image -->
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<label >Job Post Image:</label>
					                                <div class="form-group">
					                                    <span class="control-fileupload">
					                                    <label for="file">Job Post Image</label>
					                                    <input type="file" name="postjob_banner" id="postjob_banner">
					                                    </span>
					                                </div>
					                            </div>
				                            </div>

											<!-- row -->
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<div class="form-group">
														<label>Select Rank*: </label>
														<!-- <select class="language form-control" name="rank[]" multiple="multiple"> -->
															<select id="rank" name="rank[]" class="form-control custom-select rank" multiple required>
															 <!-- <option value="">Choose Position</option> -->
															<option value="Captain / Master" >Captain / Master</option>
															<option value="Chief Engineer"  >Chief Engineer</option>
															<option value="Chief Officer"  >Chief Officer</option>
															<option value="2nd Engineer"  >2nd Engineer</option>
															<option value="2nd Officer"  >2nd Officer</option>
															<option value="3rd Engineer">3rd Engineer</option>
															<option value="3rd Officer" >3rd Officer</option>
															<option value="4th Engineer">4th Engineer</option>
															<option value="Electrical Officer">Electrical Officer</option>
															<option value="Electrical Technical Officer">Electrical Technical Officer</option>
															<option value="Trainee Electrical Officer">Trainee Electrical Officer</option>
															<option value="AB">AB</option>
															<option value="Oiler">Oiler</option>
															<option value="Deck Cadet">Deck Cadet</option>
															<option value="Engine Cadet">Engine Cadet</option>
															<option value="OS">OS</option>
															<option value="Wiper">Wiper</option>
															<option value="Trainee OS">Trainee OS</option>
															<option value="Trainee Wiper">Trainee Wiper</option>
															<option value="Deck Fitter">Deck Fitter</option>
															<option value="Engine Fitter">Engine Fitter</option>
															<option value="Bosun">Bosun</option>
															<option value="Pumpman"> Pumpman</option>
															<option value="Motorman">Motorman</option>
															<option value="Crane Operator">Crane Operator</option>
															<option value="Chief Cook">Chief Cook</option>
															<option value="Cook">Cook</option>
															<option value="2nd Cook">2nd Cook</option>
															<option value="Assistant Cook">Assistant Cook</option>
															<option value="General Steward">General Steward</option>
															<option value="Trainee General Steward">Trainee General Steward</option>
														</select>
													</div>	
												</div>
											</div>

											<!-- wage--> 
											<div class="">
													<!-- <div class="col-lg-12 col-md-12 col-sm-12"> -->
												<!-- dynamic text box based on text box -->
												<div id="wages">
												</div>
													<!-- </div> -->
											</div>

											<!-- row Contract Duration -->
                                            <!-- <div class="row"> 
                                                <div class="col-lg-6  col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label>Contract Duration*</label>
                                                    <select name="contract_duration" id="contract_duration" class="form-control" required>
                                                        <option value=''>No Of Months</option>
                                                        <option value='0' {{-- old('contract_duration')=='0' ? 'selected' : ''  --}}>0</option>
                                                        <option value='1'{{-- old('contract_duration')=='1' ? 'selected' : ''  --}}>1</option>
                                                        <option value='2'{{-- old('contract_duration')=='2' ? 'selected' : ''  --}}>2</option>
                                                        <option value='3'{{-- old('contract_duration')=='3' ? 'selected' : ''  --}}>3</option>
                                                        <option value='4'{{-- old('contract_duration')=='4' ? 'selected' : ''  --}}>4</option>
                                                        <option value='5'{{-- old('contract_duration')=='5' ? 'selected' : ''  --}}>5</option>
                                                        <option value='6'{{-- old('contract_duration')=='6' ? 'selected' : ''  --}}>6</option>
                                                        <option value='7'{{-- old('contract_duration')=='7' ? 'selected' : ''  --}}>7</option>
                                                        <option value='8'{{-- old('contract_duration')=='8' ? 'selected' : ''  --}}>8</option>
                                                        <option value='9'{{-- old('contract_duration')=='9' ? 'selected' : ''  --}}>9</option>
                                                        <option value='10'{{-- old('contract_duration')=='10' ? 'selected' : ''  --}}>10</option>
                                                        <option value='11'{{-- old('contract_duration')=='11' ? 'selected' : ''  --}}>11</option>
                                                        <option value='12'{{-- old('contract_duration')=='12' ? 'selected' : ''  --}}>12</option>
                                                    </select>
                                                
                                                    </div>
                                                </div>
                                            </div> -->

                                            <!-- Rank Exp in Yesrs and MOnths  -->
                                            <!-- <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                         <label>Rank Experience is of: </label>
                                                    </div>  
                                                </div>  
                                                    <div class="col-lg-6  col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                        <label>No Of Years*</label>
                                                        <select name="experience_years" id="experience_years" class="form-control" required>
                                                            <option value=''>No of years</option>
                                                            <option value='0' {{-- old('experience_years')=='0' ? 'selected' : ''  --}}>0</option>
                                                            <option value='1'{{-- old('experience_years')=='1' ? 'selected' : ''  --}}>1</option>
                                                            <option value='2'{{-- old('experience_years')=='2' ? 'selected' : ''  --}}>2</option>
                                                            <option value='3'{{-- old('experience_years')=='3' ? 'selected' : ''  --}}>3</option>
                                                            <option value='4'{{-- old('experience_years')=='4' ? 'selected' : ''  --}}>4</option>
                                                            <option value='5'{{-- old('experience_years')=='5' ? 'selected' : ''  --}}>5</option>
                                                            <option value='6'{{-- old('experience_years')=='6' ? 'selected' : ''  --}}>6</option>
                                                            <option value='7'{{-- old('experience_years')=='7' ? 'selected' : ''  --}}>7</option>
                                                            <option value='8'{{-- old('experience_years')=='8' ? 'selected' : ''  --}}>8</option>
                                                            <option value='9'{{-- old('experience_years')=='9' ? 'selected' : ''  --}}>9</option>
                                                            <option value='10'{{-- old('experience_years')=='10' ? 'selected' : ''  --}}>10</option>
                                                            <option value='11'{{-- old('experience_years')=='11' ? 'selected' : ''  --}}>11</option>
                                                            <option value='12'{{-- old('experience_years')=='12' ? 'selected' : ''  --}}>12</option>
                                                        </select>
                                                    
                                                        </div>
                                                    </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>No Of Months*</label>
                                                        <select name="experience_months" id="jb-experience-months" class="form-control" required>
                                                            <option value=''>No of month</option>
                                                            <option value='0' {{-- old('experience_months')=='0' ? 'selected' : ''  --}}>0</option>
                                                            <option value='1'{{-- old('experience_months')=='1' ? 'selected' : ''  --}}>1</option>
                                                            <option value='2'{{-- old('experience_months')=='2' ? 'selected' : ''  --}}>2</option>
                                                            <option value='3'{{-- old('experience_months')=='3' ? 'selected' : ''  --}}>3</option>
                                                            <option value='4'{{-- old('experience_months')=='4' ? 'selected' : ''  --}}>4</option>
                                                            <option value='5'{{-- old('experience_months')=='5' ? 'selected' : ''  --}}>5</option>
                                                            <option value='6'{{-- old('experience_months')=='6' ? 'selected' : ''  --}}>6</option>
                                                            <option value='7'{{-- old('experience_months')=='7' ? 'selected' : ''  --}}>7</option>
                                                            <option value='8'{{-- old('experience_months')=='8' ? 'selected' : ''  --}}>8</option>
                                                            <option value='9'{{-- old('experience_months')=='9' ? 'selected' : ''  --}}>9</option>
                                                            <option value='10'{{-- old('experience_months')=='10' ? 'selected' : ''  --}}>10</option>
                                                            <option value='11'{{-- old('experience_months')=='11' ? 'selected' : ''  --}}>11</option>
                                                            <option value='12'{{-- old('experience_months')=='12' ? 'selected' : ''  --}}>12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div> -->
											<!-- Application Deadline data-id="datedropper-0" data-theme="my-style"-->
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Application Deadline*:</label>
														<!-- -->
														<input type="text" name="app_deadline" id="app_deadline" data-lang="en"  data-theme="my-style" class="form-control" data-large-mode="true" data-min-year="2020" data-max-year="2099" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" value="{{ old('app_deadline') }}" readonly="false">
													</div>	
												</div>
											</div>

											<!-- row -->
											<div class="row">											
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="form-group">
														<label>Vassel Type*</label>
														<select name="vassel_type" class="form-control custom-select" required><!-- multiple-->
														  <option value="" >Vessel Type</option>
                                                            <option value="Tanker Ship" {{ old('vassel_type')=='Tanker Ship' ? 'selected' : ''  }}>Tanker Ship</option>
                                                            <option value="Container Ship"{{ old('vassel_type')=='Container Ship' ? 'selected' : ''  }}>Container Ship</option>
                                                            <option value="General Cargo Ship"{{ old('vassel_type')=='General Cargo Ship' ? 'selected' : ''  }}>General Cargo Ship</option>
                                                            <option value="Bulk Carrier" {{ old('vassel_type')=='Bulk Carrier' ? 'selected' : ''  }}>Bulk Carrier</option>
                                                            <option value="Car Carrier / Ro-Ro Ship" {{ old('vassel_type')=='Car Carrier / Ro-Ro Ship' ? 'selected' : ''  }}>Car Carrier / Ro-Ro Ship</option>
                                                            <option value="Live-Stock Carrier" {{ old('vassel_type')=='Live-Stock Carrier' ? 'selected' : ''  }}>Live-Stock Carrier</option>
                                                            <option value="Passenger Ship" {{ old('vassel_type')=='Passenger Ship' ? 'selected' : ''  }}>Passenger Ship</option>
                                                            <option value="Offshore Ship" {{ old('vassel_type')=='Offshore Ship' ? 'selected' : ''  }}>Offshore Ship</option>
                                                            <option value="Special Purpose Ship" {{ old('vassel_type')=='Special Purpose Ship' ? 'selected' : ''  }}>Special Purpose Ship</option>
                                                            <option value="Other Ship"{{ old('vassel_type')=='Other Ship' ? 'selected' : ''  }}>Other Ship </option>
														</select>
													</div>	
												</div>
												
											</div>
											
											<!--Company-name email -->
											<!-- <div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Company Name*</label>
														<input type="text" name="company_name" class="form-control" placeholder="Abc PVT LTD" value="{{-- old('company_name') --}}" required>
													</div>	
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Email </label>
														<input type="email" name="email" class="form-control" placeholder="abc@gmail.com" value="{{-- old('email') --}}" required>
													</div>	
												</div>
											</div>
											
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Contact person Name</label>
														<input type="text" name="contact_person" class="form-control" placeholder="Contact person" value="{{-- old('contact_person') --}}" required>
													</div>	
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Mobile Number:</label>
														<input type="number" name="mobile_no" class="form-control" placeholder="Mobile Number" value="{{-- old('mobile_no') --}}" required>
													</div>	
												</div>
											</div> -->
							
											<!-- row -->
											<div class="row mrg-top-30">
												<div class="col-md-12 col-sm-12">
													<div class="form-group">
														<h4>Job Loation</h4>
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

											<!-- Addtess -->
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="form-group">
														<label>Address*</label>
														<input type="text" id="my-address" name="address" class="form-control" placeholder="Ex. 502, Sector 20 C, Mohali India" value="{{ old('address') }}" required>
													</div>	
												</div>
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="form-group">
														<!-- <label>City</label> -->
														<input type="hidden" id="city" name="city" class="form-control" placeholder="City" value="{{ old('city') }}" required>
													</div>	
												</div>
												
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="form-group">
														<!-- <label>State</label> -->
														<input type="hidden" id="state" name="state" class="form-control" placeholder="State" value="{{ old('state') }}" required>
													</div>	
												</div>
												
												<div class="col-lg-4 col-md-6 col-sm-12">
													<div class="form-group">
														<!-- <label>Country</label> -->
														<input type="hidden" id="country" name="country" class="form-control" placeholder="Country" value="{{ old('country') }}" required>
													</div>	
												</div>

												
											</div>

											<!-- Map -->
											<div class="row" style="display: none;">
												
												<div class="col-lg-12 col-md-12 col-sm-12">
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


    $(".rank").change(function() {
        var multipleValues = $(".rank").val() || "";
        var result = "";
        if (multipleValues != "") {
            var aVal = multipleValues.toString().split(",");
            $.each(aVal, function(i, value) {
            	result += "<div>";
                result += "<div style='display:block'>";
                result += "<label>Fill Details for Rank Position <strong>"+ value +"</strong> *: </label></div>";

                // result += "<input type='text' name='opval" + (parseInt(i) + 1) + "' value='" + "'"+value.trim()+"'" + "'>";
                // value = value.replace(' ','-');
                // value = value.replace('/','-');
                // result += "<input type='text' name='optext" + (parseInt(i) + 1) + "' value='" + $("#rank").find("option[value=" + value + "]").text().trim() + "'>";
                // result +="<div class='col-lg-6 col-md-6 col-sm-12'>" //(parseInt(i) + 1)
                // result += "<input type='number' style='width:25%;display:inline-block!important; margin-right:2px;' class='form-control' placeholder='"+ 'Contract Duration(in months) for '+value + "' name='"+'contract_duration[]' + "' value='' Required>";
                result += "<div class='row'>";
                result += "<label class='col-sm-3'>Contract Duration(in months)*:</label>";
                result += "<label class='col-sm-3'>Experience Years(in years)*:</label>";
                result += "<label class='col-sm-3'>Experience Years(in months)*:</label>";
                result += "<label class='col-sm-3'>Wage for Rank '"+ value +"'*:</label></div>";
                result += "<input class='col-sm-3 form-control' type='number' style='width:25%;display:inline-block!important; margin-right:2px;' class='form-control' placeholder='"+ 'Contract Duration(in months) for '+value + "' name='"+'contract_duration[]' + "' value='' Required>";
                
                // result += "<input type='number' style='width:25%;display:inline-block !important;margin-right:2px;' class='form-control' name='"+'experience_years[]' + "' placeholder='"+ 'Experience Years(in years) for'+value + "'value='' min='0' max='12' Required>";
				 result += "<div class='col-sm-3'><select id='jb-leve' name='experience_years[]' class='form-control' Required><option value=''>Experience in Year</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option><option value='25'>25</option><option value='26'>26</option><option value='27'>27</option><option value='28'>28</option><option value='29'>29</option><option value='30'>30</option><option value='31'>31</option><option value='32'>32</option><option value='33'>33</option><option value='34'>34</option><option value='35'>35</option><option value='36'>36</option><option value='37'>37</option><option value='38'>38</option><option value='39'>39</option><option value='40'>40</option><option value='41'>41</option><option value='42'>42</option><option value='43'>43</option><option value='44'>44</option><option value='45'>45</option><option value='46'>46</option><option value='47'>47</option><option value='48'>48</option><option value='49'>49</option><option value='50'>50</option></select></div>";
                //result += "<input class='col-sm-3 form-control' type='number' style='width:24%;display:inline-block !important;margin-right:2px;'  name='"+'experience_months[]' + "' placeholder='"+ 'Experience Months(in months) for '+value + "'value='' min='0' max='12' Required>";
                 result += "<div class='col-sm-3'><select id='jb-leve' name='experience_months[]' class='form-control' Required><option value=''>Experience in Months</option><option value='3'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option></select></div>";

                result += "<input class='col-sm-3 form-control' type='number' style='width:24%;display:inline-block !important;margin-right:2px;' name='"+'wage[]' + "' placeholder='"+ 'Wages for '+value + "'value='' Required>";
                result += "</div>";
            });


        }
        //Set Result
        $("#wages").html(result);

    });
   
    //banner image upload 
    $(function() {
      $('input[type=file]').change(function(){
        var t = $(this).val();
        var labelText = 'File : ' + t.substr(12, t.length);
        $(this).prev('label').text(labelText);
      })
    });
</script>

@endsection