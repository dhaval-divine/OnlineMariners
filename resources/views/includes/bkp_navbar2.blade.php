<nav class="navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full">
	<?php 
		
		$candidate = Session::get('userName'); 
		$employer = Session::get('employerName');
		
	?>
	<div class="container">            
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
			<i class="fa fa-bars"></i>
		</button>
		<!-- Start Header Navigation -->
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ route('homepage') }}">
				<img src="{{ url('public/assets/img/logo.png') }}" class="logo logo-scrolled" alt="Site Logo">
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbar-menu">
			<ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
				<li class="dropdown">
					<a href="{{ route('homepage') }}" class="dropdown-toggle" data-toggle="dropdown">Home</a>
					<ul class="dropdown-menu animated fadeOutUp" style="display: none; opacity: 1;">
						<li><a href="">Home Page 1</a></li>
						<li><a href="">Home Page 2</a></li>
						<li><a href="">Home Page 3</a></li>
						<li><a href="">Home Page 4</a></li>
						<li><a href="">Home Page 5</a></li>
						<li><a href="">Home Page 6</a></li>
						<li><a href="">Freelancing</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Jobs</a>
					<ul class="dropdown-menu animated fadeOutUp" style="display: none; opacity: 1;">
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Job Listing</a>
							<ul class="dropdown-menu animated fadeOutUp">
								<li><a href="">Browse Jobs</a></li>
								<li><a href="">Browse Jobs With Sidebar</a></li>
								<li><a href="">Job In Grid</a></li>
								<li><a href="">Search Job</a></li>
								<li><a href="">Popular Jobs</a></li>
							</ul>
						</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Job Detail</a>
							<ul class="dropdown-menu animated fadeOutUp">
								<li><a href="">Job Detail 1</a></li>
								<li><a href="">Job Detail 2</a></li>
								<li><a href="">Job Detail 3</a></li>
								<li><a href="">Advance Search Job</a></li>
								<li><a href="">Advance Search Job 2</a></li>
							</ul>
						</li>
						
						<li><a href="">Job With Map</a></li>
						<li><a href="">SignUp Page</a></li>
						<li><a href="">Dashboard</a></li>									
					</ul>
				</li>
				
				<li class="dropdown megamenu-fw"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Brows</a>
					<ul class="dropdown-menu megamenu-content animated fadeOutUp" role="menu" style="display: none; opacity: 1;">
						<li>
							<div class="row">
								<div class="col-menu col-md-3">
									<h6 class="title">Main Pages</h6>
									<div class="content">
										<ul class="menu-col">
											<li><a href="">New Login</a></li>
											<li><a href="">Sign In / Sign Up</a></li>
											<li><a href="">Search Job</a></li>
											<li><a href="">Accordion</a></li>
											<li><a href="">Tab Style</a></li>
											<li><a href="">Blog</a></li>
											<li><a href="">Pricing</a></li>
										</ul>
									</div>
								</div><!-- end col-3 -->
								<div class="col-menu col-md-3">
									<h6 class="title">For Candidate</h6>
									<div class="content">
										<ul class="menu-col">					
											<li><a href="">Browse Candidates</a></li>
											<li><a href="">Browse Candidate</a></li>
											<li><a href="">Top candidate</a></li>
											<li><a href="">Candidate Detail</a></li>
											<li><a href="">New Candidate Detail</a></li>
											<li><a href="">Browse Candidate Grid</a></li>
											<li><a href="">Browse Candidate With Map</a></li>
											<li><a href="">Browse Resume</a></li>
										</ul>
									</div>
								</div><!-- end col-3 -->
								<div class="col-menu col-md-3">
									<h6 class="title">For Employer</h6>
									<div class="content">
										<ul class="menu-col">											
											<li><a href="">Employer With Sidebar</a></li>
											<li><a href="">Browse Companies</a></li>
											<li><a href="">Company Detail</a></li>
											<li><a href="">Create Job</a></li>
											<li><a href="">Create Company</a></li>
											<li><a href="">Manage Company</a></li>
											<li><a href="">Manage Employee</a></li>
											<li><a href="">Employer Profile</a></li>
										</ul>
									</div>
								</div>    
								<div class="col-menu col-md-3">
									<h6 class="title">Extra Pages <span class="new-offer">New</span></h6>
									<div class="content">
										<ul class="menu-col">
											<li><a href="">Top Candidate detail</a></li>
											<li><a href="">Payment Methode</a></li>
											<li><a href="">New LogIn / SignUp</a></li>
											<li><a href="">Top candidate 2</a></li>
											<li><a href="">Premium Candidate</a></li>
											<li><a href="">Premium Candidate Detail</a></li>
											<li><a href="">Get in Touch</a></li>
										</ul>
									</div>
								</div><!-- end col-3 -->
							</div><!-- end row -->
						</li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
				
				@if(isset($candidate) && ($candidate !== ''))
				<!-- <li style="padding-top: 0.5rem;"> 
					
				</li>
				<li>  
					
				</li> -->
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
    					<ul class="navbar-nav mr-auto" style="list-style-type: none;padding-top: 5%;">
							<li class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="{{ route('cand.dashboard') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          <span style='color:green;text-transform: capitalize;'>Welcome {{ $candidate.',' }}</span>
						        </a>
						        <span class="caret"></span>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          
						          <a class="dropdown-item" href="{{ route('homepage') }}"><i class="ti-home"></i> Home</a>
						          
						          <!-- <a class="dropdown-item" href="#"> -->
						          	<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
																document.getElementById('logout-form').submit();">
																<i class="fa fa-sign-in"></i> Sign Out</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								<!-- </a> -->
						          <div class="dropdown-divider"></div>
						          	
						        </div>
					      	</li>
				       	</ul>
					  </div>
				<!-- <div class="dropdown">
				    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
			    		<a class="dropdown-item" href="{{ route('cand.dashboard') }}">
							<span style='color:green;text-transform: capitalize;'>Welcome {{ $candidate.',' }}</span>
						</a>
				    <span class="caret"></span></button>
				    <ul class="dropdown-menu">
				      <li><a href="{{ route('homepage') }}">Home</a></li>
				      <li>
				      	<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">
	                                                     <i class="fa fa-sign-in"></i>  Sign Out</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        @csrf
	                    	</form>
					    </a>
				      </li>
				    </ul>
			  	</div>
				 -->
				@endif
				
				@if(isset($employer) && ($employer !== ''))						
					<!-- <li style="padding-top: 0.5rem;">
						
					</li>
					<li>  
						
					</li> -->

					 <div class="collapse navbar-collapse" id="navbarSupportedContent">
    					<ul class="navbar-nav mr-auto" style="list-style-type: none;padding-top: 5%;">
							<li class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="{{ route('employer.dashboard') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          <span style='color:green;text-transform: capitalize;'>Welcome {{ $employer.',' }}</span>
						        </a>
						        <span class="caret"></span>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          
						          <a class="dropdown-item" href="{{ route('homepage') }}"><i class="ti-home"></i> Home</a>
						          	@if(isset($empImg[0]->profile_status) && ($empImg[0]->profile_status ==1))
							          <a href="{{ route('postjob.index') }}"  class="signin">
							          	<i class="ti-ruler-pencil"></i> Post Job
							          </a>
						          	@endif
						          <!-- <a class="dropdown-item" href="#"> -->
						          	<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
																document.getElementById('logout-form').submit();">
																<i class="fa fa-sign-in"></i> Sign Out</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								<!-- </a> -->
						          <div class="dropdown-divider"></div>
						          	
						        </div>
					      	</li>
				       	</ul>
					  </div>

					
				@endif
				
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>   
	</nav>
	<!--


	-->