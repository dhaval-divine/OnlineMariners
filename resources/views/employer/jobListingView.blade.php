@extends('layouts.app_afterLogin')

@section('content')
<?php
// echo '<pre>';
// print_r($postjobs);
// exit;
// $date_now = date("Y-m-d");
// echo '<br>'.$jobapplydeadline = $postjobs[0]->app_deadline;

// if ($date_now <= $jobapplydeadline) {
//     echo 'Allow to apply job';
// }else{
//     echo 'not Allow to apply job';
// }
// exit;
// print_r($wagelisting[0]->postjob_id);
// exit;

?>
<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url({{ url('public/assets/img/banner-10.jpg') }}">
	<div class="container">
		<h1>Job Detail</h1>
	</div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->
			
<!-- Candidate Detail Start -->
<section class="detail-desc">
	<div class="container">
	
		<div class="ur-detail-wrap top-lay">
			
			<div class="ur-detail-box">
				
				<div class="ur-thumb">

					<?php 
						//check date for job deadline
						$date_now = date("Y-m-d");
						// echo '<br>'.$date_now;
						$jobapplydeadline = $postjobs[0]->app_deadline;
						
						// var_dump(($date_now <= $jobapplydeadline));
						// exit;
						//profile pic
                        $filename = $emp[0]->company_logo;
                        $url = url('/public/companyLogo/'.$filename); 
                	?>
					<img src="{{ $url }}" class="img-responsive" alt="company_logo" width="150" height="150" />
				</div>
				<div class="ur-caption">					
					<h4 class="ur-title" style="text-transform: capitalize;">{{ $emp[0]->company_name }}</h4>
					<p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>{{ $emp[0]->address }}</p>
					<span class="ur-designation"><i class="ti-home mrg-r-5"></i>{{ $emp[0]->email }}</span>

				</div>
				
			</div>
			
			@if(Session::get('userEmail') && ($date_now <= $jobapplydeadline))			
			<div class="ur-detail-btn">				
				<a href="{{ route('cand.apply', $wagelisting[0]->postjob_id)}}" class="btn btn-warning mrg-bot-10 full-width"><i class="ti-star mrg-r-5"></i>Apply This Job</a><br>					
				<!-- <a href="#" class="btn btn-info full-width"><i class="ti-linkedin mrg-r-5"></i>Apply With Linkedin</a> -->
			</div>
			@endif
			<div class="ur-detail-btn" style="padding-left: 2%;">
				<a href="{{ route('homepage') }}" class="btn btn-info mrg-bot-10 full-width"><i class="ti-angle-left mrg-r-5"></i>Back</a>
			</div>
		</div>
		
	</div>
</section>

<?php
// echo "<pre>";
// print_r($wagelisting);
// print_r($wages);
// print_r($emp);
// exit;

?>
<!-- Job full detail Start -->
<section class="full-detail-description full-detail">
	<div class="container">
		<div class="col-md-12 col-sm-12">
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
        </div>
		<!-- Job Description -->
		<div class="col-md-12 col-sm-12">
			<div class="full-card">
				
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Job Detail</h2>
					<ul class="job-detail-des">
						<li><span>Job Title:</span>{{ $postjobs[0]->job_title }}</li>
						<li><span>Contact Person:</span>{{ $emp[0]->contact_person }}</li>
						<li><span>Vassel Type:</span>{{ $wagelisting[0]->vassel_type }}</li>
						<li><span>Last Date To Apply:</span>{{ date('m-d-Y', strtotime($postjobs[0]->app_deadline)) }}</li>
						@foreach($wagelisting as $wage)						
						<li style="font-size: 1.3em;font-weight:bold;margin-top: 3%;"><span>{{ 'Job for Rank '.$wage->rank_position }}</span></li>
						<li><span>Contact Duration:</span>{{ $wage->contract_duration }}</li>
						<li><span>Experince In Years:</span>{{ $wage->experience_years }}</li>
						<li><span>Experince In Months:</span>{{ $wage->experience_months }}</li>
						<li><span>Wage For The Post:</span>{{ '$ '.$wage->wages }}</li>
						@endforeach						
					</ul>
				</div>
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Job Description</h2>
					<ul class="job-detail-des">
						<li>{{ $postjobs[0]->job_description }}</li>
					</ul>					
				</div>
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Location</h2>
					<ul class="job-detail-des">
						<li><span>Address:</span>{{ $postjobs[0]->address }}</li>
						<li><span>City: </span>{{ $postjobs[0]->city }}</li>
						<li><span>State: </span>{{ $postjobs[0]->state }}</li>
						<li><span>Country: </span>{{ $postjobs[0]->country }}</li>
						<!-- <li><span>Zip:</span>520 548</li> -->
						<li><span>Telephone:</span>{{ $emp[0]->mobile_number }}</li>
						<!-- <li><span>Fax:</span>(622) 123 456</li> -->
						<li><span>Email:</span>{{ $emp[0]->email }}</li>
					</ul>
				</div>
				
				
				
				<!-- <div class="row row-bottom mrg-0">
				<h2 class="detail-title">Skill Requirement</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<ul class="detail-list">
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</li>
				</ul>
				</div> -->
				
				<!-- <div class="row row-bottom mrg-0">
					<h2 class="detail-title">Map Location</h2>
					<div id="map_full_width_one" class="full-width" style="height:400px;"></div>
				</div> -->
			</div>
		</div>
		<!-- End Job Description -->
		
		<!-- Start Sidebar -->
		<div class="col-md-4 col-sm-12">
			<!-- <div class="sidebar right-sidebar">
			
				<!-- Job Alert -->
				<!-- <a href="javascript:void(0)" class="btn btn-info full-width mrg-bot-20" data-toggle="modal" data-target="#job-alert">Get Job Alert!</a> -->
				
				
				<!-- <div class="side-widget">
					<h2 class="side-widget-title">Job Overview</h2>
					<div class="widget-text padd-0">
						<div class="ur-detail-wrap">
							<div class="ur-detail-wrap-body padd-top-20">
								<ul class="ove-detail-list">
								
									<li>
										<i class="ti-wallet"></i>
										<h5>Offerd Salary</h5>
										<span>£15,000 - £20,000</span>
									</li>
									
									<li>
										<i class="ti-user"></i>
										<h5>Gender</h5>
										<span>Male</span>
									</li>
									
									<li>
										<i class="ti-ink-pen"></i>
										<h5>Career Level</h5>
										<span>Excutive</span>
									</li>
									
									<li>
										<i class="ti-home"></i>
										<h5>Industry</h5>
										<span>Management</span>
									</li>
									
									<li>
										<i class="ti-shield"></i>
										<h5>Experience</h5>
										<span>5 Years</span>
									</li>
									
									<li>
										<i class="ti-book"></i>
										<h5>Qualification</h5>
										<span>Master Degree</span>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
				</div>	 -->
				
				<!-- <div class="statistic-item flex-middle">
					<div class="icon text-theme">
						<i class="ti-time theme-cl"></i>
					</div>
					<span class="text"><span class="number">2 months</span> ago</span>
				</div>
				
				<div class="statistic-item flex-middle">
					<div class="icon text-theme">
						<i class="ti-zoom-in theme-cl"></i>
					</div>
					<span class="text"><span class="number">1742</span> Views</span>
				</div>
				
				<div class="statistic-item flex-middle">
					<div class="icon text-theme">
					  <i class="ti-write theme-cl"></i>
					</div>
					<span class="text"><span class="number">17</span> Applicants</span>
				</div>
				
				
				<div class="sidebar-widgets">
				
					<div class="ur-detail-wrap">
						<div class="ur-detail-wrap-header">
							<h4>Get In Touch</h4>
						</div>
						<div class="ur-detail-wrap-body">
							<form action="#">
								<div class="form-group">
									<label>Name</label>
									<input type="email" class="form-control">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control">
								</div>
								<div class="form-group">
									<label>Message</label>
									<textarea class="form-control"></textarea>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
					
				</div> -->
				<!-- /Say Hello -->
				
			</div> 
		</div>
		<!-- End Sidebar -->
	</div>
</section>
<!-- Job full detail End -->


@endsection
@section('datepicker')
<script>
	$(document).ready(function () {
	    $('#postjob_listing').DataTable();
    });


    $(".rank").change(function() {
        var multipleValues = $(".rank").val() || "";
        var result = "<label>Wages for Rank Position*: </label>";
        if (multipleValues != "") {
            var aVal = multipleValues.toString().split(",");
            $.each(aVal, function(i, value) {

                // result += "<div>";
                // result += "<input type='text' name='opval" + (parseInt(i) + 1) + "' value='" + "'"+value.trim()+"'" + "'>";
                // value = value.replace(' ','-');
                // value = value.replace('/','-');
                // result += "<input type='text' name='optext" + (parseInt(i) + 1) + "' value='" + $("#rank").find("option[value=" + value + "]").text().trim() + "'>";
                // result +="<div class='col-lg-6 col-md-6 col-sm-12'>" //(parseInt(i) + 1)
                result += "<input type='number' class='form-control' name='"+'wage[]' + "' placeholder='"+ 'Wages for '+value + "'value='' Required>";
                result += "</div>";
            });


        }
        //Set Result
        $("#wages").html(result);

    });
   
    
</script>

@endsection