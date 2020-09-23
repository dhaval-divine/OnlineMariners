@extends('layouts.app_afterLogin')
<?php
	// echo '<pre>';
	// print_r($candidateList);
	// exit;
?>
@section('content')
<!-- Title Header Start -->
			<section class="inner-header-title" style="background-image:url({{url('/public/assets/img/bn2.jpg') }});">
				<div class="container">
					<h1>Candidate List</h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
			
			<!-- Browse Resume List Start -->
			<section class="manage-company">
				<div class="container">
					
					
					<div class="row">
					
						<!-- Single Candidate -->
						@foreach($candidateList as $candidate)
						<div class="col-md-4 col-sm-6">
							<a href="{{ route('cand.details', $candidate->id.'?frompage=candidategridlist') }}" class="item-click">
								<article>
									<div class="brows-resume grid-style">
										<div class="cnd-thumb-action">
											<div class="item-fl-box">
												<div class="brows-resume-pic">
													<?php
														$url = url('/public/profile/'.$candidate->profile_path);						
													?>
													@if(isset($url))
													<img src="{{ $url }}" class="img-responsive" alt="" />
													@else
													<img src="{{ url('/public/public/assets/img/can-4.png') }}" class="img-responsive" alt="" />
													@endif
												</div>
												<div class="brows-resume-name">
													<h4>{{ $candidate->name }}</h4>
													<span class="brows-resume-designation">{{ isset($candidate->applied_for) ? $candidate->applied_for : 'Not Updated Yet'  }}</span>
												</div>
											</div>
										</div>
										<div class="cnd-location">
											<div class="brows-resume-location">
												<p><i class="ti-location-pin"></i> 
													{{ isset($candidate->nationality) ? $candidate->nationality : 'Not Available' }}
												</p>
											</div>
										</div>
										<div class="cnd-skill">
											<div class="br-resume">
												<?php 
													if(($candidate->experience_years > 0) && ($candidate->experience_months > 0)){
														$exp = $candidate->experience_years.' Years '.$candidate->experience_months.' months';
													}else if(($candidate->experience_years > 0) && ($candidate->experience_months <1)){
														$exp = $candidate->experience_years.' Years ';
													}else if(($candidate->experience_years <1) && ($candidate->experience_months > 0)){
														$exp = $candidate->experience_months.' Months ';
													}else{
														$exp = 'No Experience';
													}
													
												?>
												Experience:<span> {{ $exp ? $exp : 'Not Avilable'  }} </span>
											</div>
										</div>
									</div>
								</article>
							</a>
						</div>
						@endforeach
						

					</div>
					
					<!-- <div class="row">
						<ul class="pagination">
							<li><a href="#"><i class="ti-arrow-left"></i></a></li>
							<li class="active"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li> 
							<li><a href="#">4</a></li> 
							<li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li> 
							<li><a href="#"><i class="ti-arrow-right"></i></a></li> 
						</ul>
					</div> -->
					
				</div>
			</section>
			<!-- Browse Resume List End -->
@endsection
