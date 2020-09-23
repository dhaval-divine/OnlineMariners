@extends('layouts.app_afterLogin')
<?php 
    // echo '<pre>';
    // // print_r($ranksWithCount);
    // print_r($locationWisehPostjob);
    // exit;
	// $company_name = Request::segment(4);
	// $city = Request::segment(5);	
?>
@php
	$candidateUser = Session::get('userName');
@endphp
@section('content')
<style type="text/css">
	.newjob-list-layout h4 a{
		border-right: unset !important;
	}
	.colps-head.collapsed:before {
	    position: absolute;
	    right: 0;
	    top: 1px;
	    font-size: 19px;
	    color: #8892a9;
	    font-family: "themify";
	    content: "" !important;
	}
</style>
<!-- Title Header Start -->
			<?php $url =  url('public/assets/img/bn2.jpg'); ?>
			<section class="inner-header-title" style="background-image:url({{ $url }});">
				<div class="container">
					<h1>Advance Search</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<section class="advance-search">
				<div class="container">
					<div class="row">
					
						<div class="col-md-4 col-sm-12">
							<div class="full-sidebar-wrap">
								
								<a href="javascript:void(0)" onclick="openNav()" class="btn btn-dark full-width mrg-bot-20 hidden-lg hidden-md hidden-xl"><i class="ti-filter mrg-r-5"></i>Filter Search</a>
								
								<!-- Job Alert -->
								<!-- <a href="javascript:void(0)" class="btn btn-info full-width mrg-bot-20" data-toggle="modal" data-target="#job-alert">Get Job Alert!</a> -->
								<!-- /Job Alert -->
								
								<div class="show-hide-sidebar hidden-xs hidden-sm">
								
									<!-- Search Job -->
									<!-- <div class="sidebar-widgets">
									
										<div class="ur-detail-wrap">
											<div class="ur-detail-wrap-header">
												<h4>Search Job Here</h4>
											</div>
											<div class="ur-detail-wrap-body">
												<form>
													<div class="form-group">
														<label>Keyword</label>
														<input type="text" name="company_name" class="form-control" placeholder="Job Title or Keyword">
													</div>
													<div class="form-group">
														<label>Location</label>
														<input type="text" name="city" class="form-control" placeholder="ex. City name">
													</div>
													<div class="form-group">
														<label>Category</label>
														<select id="choose-category" name="rank_position" class="form-control">
															<option>Choose Category</option>
															<option value="Captain / Master">Captain / Master</option>
							                                <option value="Chief Engineer">Chief Engineer</option>
							                                <option value="Chief Officer">Chief Officer</option>
							                                <option value="2nd Engineer">2nd Engineer</option>
							                                <option value="2nd Officer" >2nd Officer</option>
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
													<button type="submit" class="btn btn-primary full-width">Find Jobs</button>
												</form>
											</div>
										</div>
										
									</div> -->
									<!-- /Search Job -->
								
									<!-- Top Designation -->
									<div class="sidebar-widgets">
										<div class="ur-detail-wrap">
										
											<div class="ur-detail-wrap-header">
												<h4>Top Designation</h4>
											</div>
											<div class="ur-detail-wrap-body">
												<ul class="advance-list">
													<?php $i = 1;?>
													@foreach($ranksWithCount as $rank)
													<li>
														<?php 
														if($rank->rank_position == 'Captain / Master'){
															$ranklist = 'Captain_Master';
														}else{
															$ranklist = $rank->rank_position;
														}
														$rlist = '?rank='.$ranklist;
														?>
														<!-- <a href="{{ route('joblist.browse', $rlist) }}"> -->
														<!-- <span class="custom-checkbox"> -->
															<!-- id="aw" -->
															<!-- <input type="checkbox" name="rank_filter" id="rank_{{ $i }}" value="{{ $rank->rank_position }}"> -->
															<label for="aw"></label>
														</span>
														{{ $rank->rank_position }}
													<!-- </a> -->
														<span class="pull-right">{{ $rank->rankcount }}</span>
													</li>
													@php $i++ @endphp
													@endforeach
													<!-- <li>
														<span class="custom-checkbox">
															<input type="checkbox" id="dd">
															<label for="dd"></label>
														</span>
														Business Executive
														<span class="pull-right">78</span>
													</li>
													<li>
														<span class="custom-checkbox">
															<input type="checkbox" id="er">
															<label for="er"></label>
														</span>
														Supervisor
														<span class="pull-right">12</span>
													</li>
													<li>
														<span class="custom-checkbox">
															<input type="checkbox" id="tr">
															<label for="tr"></label>
														</span>
														Team Leader
														<span class="pull-right">85</span>
													</li> -->
												</ul>
											</div>
										
										</div>
									</div>
									<!-- /Top Designation -->
								
									<!-- Experince -->
									<!-- <div class="sidebar-widgets">
										<div class="ur-detail-wrap">
										
											<div class="ur-detail-wrap-header">
												<h4>Experince</h4>
											</div>
											<div class="ur-detail-wrap-body">
												<ul class="advance-list">
													<li>
														<span class="custom-checkbox">
															<input type="checkbox" id="uy">
															<label for="uy"></label>
														</span>
														0 - 1 Year
														<span class="pull-right">102</span>
													</li>
													<li>
														<span class="custom-checkbox">
															<input type="checkbox" id="io">
															<label for="io"></label>
														</span>
														1 - 2 Year
														<span class="pull-right">78</span>
													</li>
													<li>
														<span class="custom-checkbox">
															<input type="checkbox" id="lo">
															<label for="lo"></label>
														</span>
														2 - 4 Year
														<span class="pull-right">12</span>
													</li>
													<li>
														<span class="custom-checkbox">
															<input type="checkbox" id="kj">
															<label for="kj"></label>
														</span>
														4 - 6 Year
														<span class="pull-right">85</span>
													</li>
												</ul>
											</div>
										
										</div>
									</div> -->
									<!-- /Experince -->
								
									<!-- Job Type -->
									<!-- <div class="sidebar-widgets">
										<div class="ur-detail-wrap colps-wrap">
										
											<div class="ur-detail-wrap-header">
												<h4 class="colps-head collapsed" data-toggle="collapse" href="#jb-types" role="button" aria-expanded="false" aria-controls="jb-types">Job Type</h4>
											</div>
											<div class="collapse" id="jb-types">
												<div class="ur-detail-wrap-body">
													<ul class="advance-list">
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="1">
																<label for="1"></label>
															</span>
															Full Time
															<span class="pull-right">102</span>
														</li>
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="2">
																<label for="2"></label>
															</span>
															Part Time
															<span class="pull-right">78</span>
														</li>
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="3">
																<label for="3"></label>
															</span>
															Internship
															<span class="pull-right">12</span>
														</li>
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="4">
																<label for="4"></label>
															</span>
															Freelancer
															<span class="pull-right">85</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div> -->
									<!-- /Job Type -->
								
									<!-- Location -->
									<div class="sidebar-widgets">
										<div class="ur-detail-wrap colps-wrap">
										
											<div class="ur-detail-wrap-header">
												<h4 class="colps-head collapsed" data-toggle="collapse" href="#jb-location" role="button" aria-expanded="false" aria-controls="jb-location">Popular Locations</h4>
											</div>
											<div class="collapse in" id="jb-location">
												<div class="ur-detail-wrap-body">
													<ul class="advance-list">
														
														@foreach($locationWisehPostjob as $location)
														<li>
															<!-- <span class="custom-checkbox">
																<input type="checkbox" id="1">
																<label for="1"></label>
															</span> -->
															<?php //url(''); ;?>
															<a href="{{ $rlist.'&city='.$location->city }}">
																{{ $location->city }}
															</a>
															<span class="pull-right">{{ $location->citycount }}</span>
														</li>
														@endforeach
														<!-- <li>
															<span class="custom-checkbox">
																<input type="checkbox" id="2">
																<label for="2"></label>
															</span>
															Chandigarh
															<span class="pull-right">78</span>
														</li>
														
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="3">
																<label for="3"></label>
															</span>
															Chennai
															<span class="pull-right">12</span>
														</li>
														
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="4">
																<label for="4"></label>
															</span>
															Delhi
															<span class="pull-right">85</span>
														</li> -->
													</ul>
												</div>
											</div>
										</div>
									</div>
									<!-- /Popular Locations -->
								
									<!-- Compensation -->
									<!-- <div class="sidebar-widgets">
										<div class="ur-detail-wrap colps-wrap">
										
											<div class="ur-detail-wrap-header">
												<h4 class="colps-head collapsed" data-toggle="collapse" href="#jb-Compensation" role="button" aria-expanded="false" aria-controls="jb-Compensation">Compensation</h4>
											</div>
											<div class="collapse" id="jb-Compensation">
												<div class="ur-detail-wrap-body">
													<ul class="advance-list">
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="1">
																<label for="1"></label>
															</span>
															Under $10,000
															<span class="pull-right">102</span>
														</li>
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="2">
																<label for="2"></label>
															</span>
															$10,000 - $15,000
															<span class="pull-right">78</span>
														</li>
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="3">
																<label for="3"></label>
															</span>
															$15,000 - $20,000
															<span class="pull-right">12</span>
														</li>
														<li>
															<span class="custom-checkbox">
																<input type="checkbox" id="4">
																<label for="4"></label>
															</span>
															$20,000 - $30,000
															<span class="pull-right">85</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div> -->
									<!-- /Compensation -->
								</div>
								
							</div>
						</div>
					
						<div class="col-md-8 col-sm-12">
							
							<!--Filter -->							
							<!-- <div class="row">
								<div class="col-md-12">
									<div class="filter-wraps">
										
										<div class="filter-wraps-one">
											<i class="ti-search"></i>
											<ul>
												<li><a href="#">CSS3<i class="ti-close"></i></a></li>
												<li><a href="#">Wordpress<i class="ti-close"></i></a></li>
												<li><a href="#">Photoshop<i class="ti-close"></i></a></li>
											</ul>
										</div>
										<div class="filter-wraps-two">
											<h5><a href="#">RESET FILTERS</a></h5>
										</div>
										
									</div>
								</div>
							</div> -->
							<!--/.Filter -->
							
							<!--Browse Job -->							
							<div class="row">
								<div class="col-md-12">
									
									<!-- Dynamic Single New Job -->
									@foreach($allPostJobLists as $browsePostjob)
									
									<div class="newjob-list-layout" style="border-right: unset !important;">
										<div class="cll-wrap">
											<div class="cll-thumb">
												<a href="">
													<img src="assets/img/com-1.jpg" class="img-responsive img-circle" alt="" />
												</a>
											</div>
											<div class="cll-caption">
												<h4><a href="">{{ mb_strimwidth($browsePostjob->rank_position, 0, 17, "...") }}</a>	</h4>
												<ul>
													<li>
														<i class="ti-home cl-danger"></i>
														{{ mb_strimwidth($browsePostjob->company_name, 0, 35,'...') }}
													</li>
													<li>
														<i class="ti-credit-card cl-success"></i>
														{{ '$ '.mb_strimwidth($browsePostjob->wages, 0,17,'...') }}
													</li>
												</ul>
											</div>
										</div>
										@if(isset($candidateUser))
										<div class="cll-right">
											<a href=" {{ route('cand.apply', 
											[$browsePostjob->id,$browsePostjob->postwage_id]) }}" class="btn theme-btn btn-shortlist"><i class="ti-arrow-right"></i>Apply</a>
										</div>
										@endif
									</div>
									@endforeach									
									@if(count($allPostJobLists) < 1)
									<div class="row" style="text-align: center;padding-top: 5%">
										<div class="col-sm-12">
											<h3 style="color:#03a84e;">Requested Data Not Found</h3>
										</div>
									</div>
									@endif
									<!-- Single New Job -->
									<!-- <div class="newjob-list-layout">
										<div class="cll-wrap">
											<div class="cll-thumb">
												<a href="job-detail-2.html"><img src="assets/img/com-1.jpg" class="img-responsive img-circle" alt="" /></a>
											</div>
											<div class="cll-caption">
												<h4><a href="job-detail-2.html">Product Designer</a><span class="jb-status full-time">Full Time</span></h4>
												<ul>
													<li><i class="ti-home cl-danger"></i>Trish Technologies</li>
													<li><i class="ti-credit-card cl-success"></i>$2000 - $3500 P.A </li>
												</ul>
											</div>
										</div>
										
										<div class="cll-right">
											<a href="job-detail-2.html" class="btn theme-btn btn-shortlist"><i class="ti-arrow-right"></i>Apply</a>
										</div>
									</div>
									
									
									<div class="newjob-list-layout">
										<div class="cll-wrap">
											<div class="cll-thumb">
												<a href="job-detail-2.html"><img src="assets/img/com-2.jpg" class="img-responsive img-circle" alt="" /></a>
											</div>
											<div class="cll-caption">
												<h4><a href="job-detail-2.html">Wordpress Expert</a><span class="jb-status part-time">Part Time</span></h4>
												<ul>
													<li><i class="ti-home cl-danger"></i>Disha Technologies</li>
													<li><i class="ti-credit-card cl-success"></i>$2500 - $4200 P.A </li>
												</ul>
											</div>
										</div>
										
										<div class="cll-right">
											<a href="job-detail-2.html" class="btn theme-btn btn-shortlist"><i class="ti-arrow-right"></i>Apply</a>
										</div>
									</div>
									
									
									<div class="newjob-list-layout">
										<div class="cll-wrap">
											<div class="cll-thumb">
												<a href="job-detail-2.html"><img src="assets/img/com-3.jpg" class="img-responsive img-circle" alt="" /></a>
											</div>
											<div class="cll-caption">
												<h4><a href="job-detail-2.html">Graphic Designer</a><span class="jb-status freelancer-time">Freelancer</span></h4>
												<ul>
													<li><i class="ti-home cl-danger"></i>Tincle Hub</li>
													<li><i class="ti-credit-card cl-success"></i>$1900 - $2500 P.A </li>
												</ul>
											</div>
										</div>
										
										<div class="cll-right">
											<a href="job-detail-2.html" class="btn theme-btn btn-shortlist"><i class="ti-arrow-right"></i>Apply</a>
										</div>
									</div> -->
									
									
									
									
								</div>
							</div>
							<!--/.Browse Job-->
							
							@if(isset($allPostJobLists))
							<div class="row mrg-0">
								{!! $allPostJobLists->render() !!}
								<!-- <ul class="pagination">
									<li><a href="#"><i class="ti-arrow-left"></i></a></li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li> 
									<li><a href="#">4</a></li> 
									<li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li> 
									<li><a href="#"><i class="ti-arrow-right"></i></a></li> 
								</ul> -->
							</div>
							@endif
						</div>
						
					</div>
				</div>
			</section>
@endsection

@section('datepicker')
<script>
	var favorite = [];
            
	
	$('input[id^="rank_"]').not('#checkbox_all').click(function () {
            // $('#checkbox_all').prop('checked', false);

   		alert($(this).val());  

   		$.each($("input[name='rank_filter']:checked"), function(){            
            favorite.push($(this).val());
        });

		// alert(  JSON.stringify(favorite) );
  //       alert("My favourite sports are: " + favorite.join(", "));

        $.ajaxSetup({
		    headers: {
		      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		//get unique data in array
        function onlyUnique(value, index, self) { 
		    return self.indexOf(value) === index;
		}

		// usage example:
		var rankSearchList = favorite;
		// var a = ['a', 1, 'a', 2, '1'];
		var rankSearchList = rankSearchList.filter( onlyUnique );

        // var rankSearchList = JSON.stringify(favorite);
        
		$.ajax({
		type:"POST",
		url: "{{ route('rank.filter') }}",
		data: {rankSearchList: rankSearchList},
		success: function(data){
				// var postwage_id = JSON.parse(data);
				// $('#postwage_id').val(postwage_id);	      
			}
		})
	
	});
</script>
@endsection