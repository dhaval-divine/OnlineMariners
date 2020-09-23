@extends('layouts.app_website')

@section('content')
<?php
// echo $path = url("public/assets/img/".$joblists->company_logo);
// echo $company_logo =  $joblists[0]->company_logo;
// echo '<pre>';
// print_r($joblists);
// exit;
?>
<!--home page -->
<section>
            <div class="container">
            	<!-- Latest Job List-->
                <div class="row">
                    <div class="main-heading">
                        <!-- <p>200 New Jobs</p> -->
                        <!-- <h2>New & Random <span>Jobs</span></h2> -->
                        <h2>Featured Job</h2>
                    </div>
                </div>

                <div class="row extra-mrg">
					@if (count($joblists) > 0)
						<!-- Single New Job -->
						@foreach($joblists as $job)
	                    <div class="col-md-3 col-sm-6">
	                        <div class="job-instructor-layout">
								<!-- <span class="tg-themetag tg-featuretag">Premium</span> -->
								<?php $logo  = isset($job->company_logo) ? $job->company_logo : ''; ?>
								<div class="brows-job-type"><span class="freelanc"> {{ mb_strimwidth($job->company_name, 0, 25, "...") }} </span></div>
								<div class="job-instructor-thumb">									
									<a href="{{ route('postjob.details', $job->id) }}"><img src="{{ url('public/companyLogo/'.$logo) }}" class="img-fluid" alt="" width="80" height="80" /></a>
								</div>
								<div class="job-instructor-content">
									<h4 class="instructor-title"><a href="{{ route('postjob.details', $job->id) }}">{{ mb_strimwidth($job->job_title, 0, 25, "...") }}</a></h4>
									<div class="instructor-skills">
										{{ 'Vassel Type: '.mb_strimwidth($job->vassel_type, 0, 14, "...") }}
									</div>
								</div>
								<div class="job-instructor-footer">
									<div class="instructor-students">
										<h5 class="instructor-scount">{{-- 'Contract for '.$job->contract_duration.' Months' --}}</h5>
									</div>
									<div class="instructor-corses">
										<span class="c-counting">{{ date('d-m-Y', strtotime($job->app_deadline)) }}</span>
									</div>
								</div>
							</div>
	                    </div>                    
	                    @endforeach
	                    <!-- url('public/empProfile/'.$emp[0]->company_logo) -->
					@else
    					<div class="col-lg-12 col-md-12 col-sm-12">
    						<div style="margin: 5% 35%;font-size: 2rem;text-align: center;font-weight: 500;">
    							</h1>No latest Job Post avilable.</h1>
    						</div>
    					</div>
					@endif
					<!-- <div style="text-align: center;padding-top: 2%;color:green;" class="row col-md-12 col-sm-12">
						<a href="">View More...</a>
					</div> -->

					<!-- Single New Job -->
                    <!-- <div class="col-md-3 col-sm-6">
                        <div class="job-instructor-layout">
							<div class="brows-job-type"><span class="full-time">Full Time</span></div>
							<div class="job-instructor-thumb">
								<a href="job-detail.html"><img src="public/assets/img/com-3.jpg" class="img-fluid" alt="" /></a>
							</div>
							<div class="job-instructor-content">
								<h4 class="instructor-title"><a href="job-detail.html">App Developer</a></h4>
								<div class="instructor-skills">
									CSS3, HTML5, Javascript, Bootstrap, Jquery
								</div>
							</div>
							<div class="job-instructor-footer">
								<div class="instructor-students">
									<h5 class="instructor-scount">$4.2K - $5K</h5>
								</div>
								<div class="instructor-corses">
									<span class="c-counting">2 Open</span>
								</div>
							</div>
						</div>
                    </div> -->
					
                    <!-- Single New Job -->
                    <!-- <div class="col-md-3 col-sm-6">
                        <div class="job-instructor-layout">
							<div class="brows-job-type"><span class="part-time">Part Time</span></div>
							<div class="job-instructor-thumb">
								<a href="job-detail.html"><img src="public/assets/img/com-4.jpg" class="img-fluid" alt="" /></a>
							</div>
							<div class="job-instructor-content">
								<h4 class="instructor-title"><a href="">Software Developer</a></h4>
								<div class="instructor-skills">
									CSS3, HTML5, Javascript, Bootstrap, Jquery
								</div>
							</div>
							<div class="job-instructor-footer">
								<div class="instructor-students">
									<h5 class="instructor-scount">$6.5K - $8K</h5>
								</div>
								<div class="instructor-corses">
									<span class="c-counting">02 Open</span>
								</div>
							</div>
						</div>
                    </div> -->
					
					<!-- Single New Job -->
                    <!-- <div class="col-md-3 col-sm-6">
                        <div class="job-instructor-layout">
							<span class="tg-themetag tg-featuretag">Premium</span>
							<div class="brows-job-type"><span class="freelanc">Freelancer</span></div>
							<div class="job-instructor-thumb">
								<a href="job-detail.html"><img src="public/assets/img/com-5.jpg" class="img-fluid" alt="" /></a>
							</div>
							<div class="job-instructor-content">
								<h4 class="instructor-title"><a href="job-detail.html">iPhone Developer</a></h4>
								<div class="instructor-skills">
									CSS3, HTML5, Javascript, Bootstrap, Jquery
								</div>
							</div>
							<div class="job-instructor-footer">
								<div class="instructor-students">
									<h5 class="instructor-scount">$3.7K - $6K</h5>
								</div>
								<div class="instructor-corses">
									<span class="c-counting">04 Open</span>
								</div>
							</div>
						</div>
                    </div> -->					                                       		
                </div> 
                <!-- End Latest Job List-->               
            </div>
        </section>
		
        <div class="clearfix"></div>
        <section class="video-sec dark" id="video" style="background-image:url(public/assets/img/banner-10.jpg);">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
                        <p>Best For Your Projects</p>
                        <h2>Watch Our <span>video</span></h2></div>
                </div>
                <div class="video-part"><a href="#" data-toggle="modal" data-target="#my-video" class="video-btn"><i class="fa fa-play"></i></a></div>
            </div>
        </section>
        <div class="clearfix"></div>
        <section class="how-it-works">
            <div class="container">
                <div class="row" data-aos="fade-up">
                    <div class="col-md-12">
                        <div class="main-heading">
                            <p>Working Process</p>
                            <h2>How It <span>Works</span></h2></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="working-process"><span class="process-img"><img src="public/assets/img/step-1.png" class="img-responsive" alt=""/><span class="process-num">01</span></span>
                            <h4>Create An Account</h4>
                            <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers find place best.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="working-process"><span class="process-img"><img src="public/assets/img/step-2.png" class="img-responsive" alt=""/><span class="process-num">02</span></span>
                            <h4>Search Jobs</h4>
                            <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers find place best.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="working-process"><span class="process-img"><img src="public/assets/img/step-3.png" class="img-responsive" alt=""/><span class="process-num">03</span></span>
                            <h4>Save & Apply</h4>
                            <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers find place best.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		
        <div class="clearfix"></div>
        <section class="testimonial" id="testimonial">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
                        <p>What Say Our Client</p>
                        <h2>Our Success <span>Stories</span></h2></div>
                </div>
                <div class="row">
                    <div id="client-testimonial-slider" class="owl-carousel">
                        <div class="client-testimonial">
                            <div class="pic"><img src="public/assets/img/client-1.jpg" alt=""></div>
                            <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua.</p>
                            <h3 class="client-testimonial-title">Lacky Mole</h3>
                            <ul class="client-testimonial-rating">
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star"></li>
                            </ul>
                        </div>
                        <div class="client-testimonial">
                            <div class="pic"><img src="public/assets/img/client-2.jpg" alt=""></div>
                            <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua.</p>
                            <h3 class="client-testimonial-title">Karan Wessi</h3>
                            <ul class="client-testimonial-rating">
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                            </ul>
                        </div>
                        <div class="client-testimonial">
                            <div class="pic"><img src="public/assets/img/client-3.jpg" alt=""></div>
                            <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua.</p>
                            <h3 class="client-testimonial-title">Roul Pinchai</h3>
                            <ul class="client-testimonial-rating">
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star"></li>
                            </ul>
                        </div>
                        <div class="client-testimonial">
                            <div class="pic"><img src="public/assets/img/client-1.jpg" alt=""></div>
                            <p class="client-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua.</p>
                            <h3 class="client-testimonial-title">Adam Jinna</h3>
                            <ul class="client-testimonial-rating">
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star-o"></li>
                                <li class="fa fa-star"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

		<!-- Pricing -->
		<!-- pricing Section Start -->
<section class="pricing">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="main-heading">
								<p>Best Candidate of The Year</p>
								<h2>Hire Expert <span>Candidate</span></h2>
							</div>
						</div>
					</div>
					<!--/row-->
					
					<div class="row">
						
						<!-- Single Freelancer Style 2 -->
						<div class="col-md-4 col-sm-6">
							<div class="top-candidate-wrap style-2">
								<div class="top-candidate-box">
									<span class="tpc-status">Available</span>
									<h4 class="flc-rate">$17/hr</h4>
									<div class="tp-candidate-inner-box">
										<div class="top-candidate-box-thumb">
											<img src="public/assets/img/can-5.jpg" class="img-responsive img-circle" alt="" />
										</div>
										<div class="top-candidate-box-detail">
											<h4>Agustin L. Smith</h4>
											<span class="location">Australia</span>
										</div>
										<div class="rattings">
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star-half fill"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<div class="top-candidate-box-extra">
										<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui.</p>
										<ul>
											<li>Php</li>
											<li>Android</li>
											<li>Html</li>
											<li class="more-skill bg-primary">+3</li>
										</ul>
									</div>
									<a href="top-candidate-detail.html" class="btn btn-candidate-two bg-default">View Detail</a>
									<a href="#l" class="btn btn-candidate-two bg-info">Shortlist</a>
								</div>
							</div>
						</div>
						
						<!-- Single Freelancer Style 2 -->
						<div class="col-md-4 col-sm-6">
							<div class="top-candidate-wrap style-2">
								<div class="top-candidate-box">
									<span class="tpc-status bg-warning">At Work</span>
									<h4 class="flc-rate">$22/hr</h4>
									<div class="tp-candidate-inner-box">
										<div class="top-candidate-box-thumb">
											<img src="public/assets/img/can-5.jpg" class="img-responsive img-circle" alt="" />
										</div>
										<div class="top-candidate-box-detail">
											<h4>Delores R. Williams</h4>
											<span class="location">United States</span>
										</div>
										<div class="rattings">
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star-half fill"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<div class="top-candidate-box-extra">
										<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui.</p>
										<ul>
											<li>Php</li>
											<li>Android</li>
											<li>Html</li>
											<li class="more-skill bg-primary">+3</li>
										</ul>
									</div>
									<a href="top-candidate-detail.html" class="btn btn-candidate-two bg-default">View Detail</a>
									<a href="#l" class="btn btn-candidate-two bg-info">Shortlist</a>
								</div>
							</div>
						</div>
						
						<!-- Single Freelancer Style 2 -->
						<div class="col-md-4 col-sm-6">
							<div class="top-candidate-wrap style-2">
								<div class="top-candidate-box">
									<span class="tpc-status">Available</span>
									<h4 class="flc-rate">$19/hr</h4>
									<div class="tp-candidate-inner-box">
										<div class="top-candidate-box-thumb">
											<img src="public/assets/img/can-5.jpg" class="img-responsive img-circle" alt="" />
										</div>
										<div class="top-candidate-box-detail">
											<h4>Daniel Disroyer</h4>
											<span class="location">Bangladesh</span>
										</div>
										<div class="rattings">
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star fill"></i>
											<i class="fa fa-star-half fill"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<div class="top-candidate-box-extra">
										<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui.</p>
										<ul>
											<li>Php</li>
											<li>Android</li>
											<li>Html</li>
											<li class="more-skill bg-primary">+3</li>
										</ul>
									</div>
									<a href="top-candidate-detail.html" class="btn btn-candidate-two bg-default">View Detail</a>
									<a href="#l" class="btn btn-candidate-two bg-info">Shortlist</a>
								</div>
							</div>
						</div>
						
					</div>
					
					<!-- Single Freelancer -->
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="text-center">
								<a href="freelancers-2.html" class="btn btn-primary">Load More</a>
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- End Candidate Section -->
			
			
@endsection
