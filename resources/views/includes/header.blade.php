
        <div class="clearfix"></div>
        <div class="banner trans" style="background-image:url({{asset('public/assets/img/slider-1.jpg') }});"  data-overlay="6">
            <div class="container">
                <div class="banner-caption">
                    <div class="col-md-12 col-sm-12 banner-text">
                        <h1>Browse Jobs</h1>
                        <div class="full-search-2 eclip-search italian-search hero-search-radius">
							<div class="hero-search-content">
								
								<div class="row">
									<!-- joblist.companyfilter -->
									<form name="home_job_search" method="get" action="{{ route('joblist.browse') }}">
									@csrf
									<input type="hidden" name="homepage" value="homepage">
									<div class="col-lg-4 col-md-4 col-sm-12 small-padd">
										<div class="form-group">
											<div class="input-with-icon">
												<input type="text" name="company_name" class="form-control b-r" placeholder="Search By Company Name">
												<i class="ti-search"></i>
											</div>
										</div>
									</div>
									
									<div class="col-lg-3 col-md-3 col-sm-12 small-padd b-r">
										<div class="form-group">
										<div class="input-with-icon">
											<input type="text" id="my-address" name="city" class="form-control" placeholder="Search By Enter City Name">
											<!-- <select id="choose-city" class="form-control">
												<option>Choose City</option>
												<option>Chandigarh</option>
												<option>London</option>
												<option>England</option>
												<option>Pratapcity</option>
												<option>Ukrain</option>
												<option>Wilangana</option>
											</select> -->
											<i class="ti-location-pin"></i>
										</div>
									</div>
									</div>
		
									
									<div class="col-lg-3 col-md-3 col-sm-12 small-padd">
										<div class="form-group">
										<div class="input-with-icon">
											<select name="rank_position" id="choose-category" class="form-control">
												<option>Job Category</option>
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
											<i class="ti-layers"></i>
										</div>
									</div>
									</div>
									
									<div class="col-lg-2 col-md-2 col-sm-12 small-padd">
										<div class="form-group">
											<div class="form-group">
												<!-- <a href="#" class="btn btn-primary search-btn">Search</a> -->
												<button type="submit" class="btn btn-primary full-width">Search</button>
											</div>
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="clearfix"></div>
        <!-- Company Brand Start -->
			<div class="company-brand">
				<div class="container">
					<div id="company-brands" class="owl-carousel">
						<div class="brand-img">
							<img src="{{ asset('public/assets/img/microsoft-home-dark.png') }}" class="img-responsive" alt="" />
						</div>
						<div class="brand-img">
							<img src="{{ asset('public/assets/img/img-home-dark.png') }}" class="img-responsive" alt="" />
						</div>
						<div class="brand-img">
							<img src="{{ asset('public/assets/img/mothercare-hom-darke.png') }}" class="img-responsive" alt="" />
						</div>
						<div class="brand-img">
							<img src="{{ asset('public/assets/img/paypal-home-dark.png') }}" class="img-responsive" alt="" />
						</div>
						<div class="brand-img">
							<img src="{{ asset('public/assets/img/serv-home-dark.png') }}" class="img-responsive" alt="" />
						</div>
						<div class="brand-img">
							<img src="{{ asset('public/assets/img/xerox-home-dark.png') }}" class="img-responsive" alt="" />
						</div>
						<div class="brand-img">
							<img src="{{ asset('public/assets/img/yahoo-home-dark.png') }}" class="img-responsive" alt="" />
						</div>
						<div class="brand-img">
							<img src="{{ asset('public/assets/img/mothercare-hom-darke.png') }}" class="img-responsive" alt="" />
						</div>
					</div>
				</div>
			</div>
			<!-- Company Brand End -->