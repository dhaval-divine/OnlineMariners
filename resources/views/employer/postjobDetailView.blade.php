@extends('layouts.app_afterLogin')

@section('content')
<?php
// echo '<pre>';
// print_r($wagelist);
// print_r($empImg);
// exit;
?>
<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url({{ url('public/assets/img/banner-10.jpg') }}">
	<div class="container">
		<h1>Postjob Detail</h1>
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

						if($empImg[0]->company_logo == ''){?>
							<img src="{{ url('/public/companyLogo/emp-default.png') }}" class="img-responsive" alt="company_logo" width="150" height="150" />
					<?php }else{
							$filename = $empImg[0]->company_logo;
							$url = url('/public/companyLogo/'.$filename); 												
							// echo $url;
                	?>

                	<img src="{{ $url }}" class="img-responsive" alt="company_logo" width="150" height="150" />		
					<?php	} ?>
					
				</div>
				<div class="ur-caption">
					<h4 class="ur-title" style="text-transform: capitalize; padding-bottom: 2%">{{ $empImg[0]->name }}</h4>
					<p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>{{ $empImg[0]->country }}</p>
					<p class="ur-location"><i class="ti-mobile mrg-r-5"></i>{{ $empImg[0]->mobile_number }}</p>
					<span class="ur-designation"><i class="ti-email mrg-r-5"></i>{{ $empImg[0]->email }}</span>
				</div>				
			</div>

			<div class="ur-detail-btn">				
				<a href="{{ route('postjob.listing') }}" class="btn btn-warning mrg-bot-10 full-width"><i class="ti-angle-left	 mrg-r-5"></i>Back</a>
			</div>			
		</div>
	</div>
</section>

<?php
// echo "<pre>";
// print_r($skill_traing);
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
					<h2 class="detail-title">Details</h2>
					<ul class="job-detail-des">
						<li><span>Job Title:</span> {{ $wagelist[0]->job_title }}</li>
						<li><span>Job Description</span> {{ $wagelist[0]->job_description }}</li>								
						<li><span>Applied Deadline:</span> {{ date('m-d-Y', strtotime($wagelist[0]->app_deadline)) }}</li>

						<li><span>Vassel Type</span> {{ $wagelist[0]->vassel_type }}</li>
					</ul>
				</div>
				@if($wagelist)
				@foreach($wagelist as $w)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Postjob Rank Details </h2>
					<ul class="job-detail-des">						
						<li>
							<span>Rank Name:</span> {{ isset($w->rank_position) ? $w->rank_position : '-'  }}
						</li>
						<li>
							<span>Contract Duration:</span> {{ isset($w->contract_duration) ? $w->contract_duration.' Months' : '-'}}
						</li>
						<li>
							<span>Experience Required:</span> {{ $w->experience_years.' Years '.$w->experience_months.' Months' }}
						</li>
						<li><span>Wage:</span> {{ isset($w->wages) ? $w->wages : '-'  }}</li>
					</ul>
				</div>
				@endforeach

				@endif
				@if(isset($wagelist[0]->postjob_banner))
					<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Postjob Banner</h2>
					<ul class="job-detail-des">						
						<li>
							<?php $url = url('/public/postjobBanner/'.$wagelist[0]->postjob_banner); ?>
							<img src="{{ $url }}" alt="banner_image" width="800" height="450" />
						</li>
					</ul>
				</div>	
				@endif
			</div>
		</div>
		<!-- End Job Description -->
		
		<!-- Start Sidebar -->
		<!-- <div class="col-md-4 col-sm-12"> -->
			<!-- <div class="sidebar right-sidebar">
			
				
				
			</div> 
		</div>
		<!-- End Sidebar -->
	</div>
	<!-- End container -->
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