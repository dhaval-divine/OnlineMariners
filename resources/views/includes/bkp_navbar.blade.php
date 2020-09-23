<style type="text/css">
	nav>li.dropdown>a.dropdown-toggle:after{
		content: '';
	}
</style>
<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
			<?php 
				$candidate = Session::get('userName'); 
				$employer = Session::get('employerName');				
			?>
            <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><i class="fa fa-bars"></i></button>
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('homepage') }}">
                        <img src="{{ url('public/assets/img/logo.png') }}" class="logo logo-display" alt="">
                        <img src="{{ url('public/assets/img/logo.png') }}" class="logo logo-scrolled" alt="">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    	@if(!isset($candidate) && !isset($employer))
                        <li>
							<a href="{{ route('signup') }}"><i class="fa fa-pencil" aria-hidden="true"></i>SignUp</a>
						</li>
						@endif						
						@if(isset($candidate) && ($candidate !== ''))
							<!-- <li style="padding-top: 0.5rem;color:white;text-transform: capitalize;"> 
								<a href="{{ route('cand.dashboard') }}">
									<span style='text-transform: capitalize;'>Welcome {{ $candidate.',' }}</span>
								</a>
							<li>  
								
							</li> -->
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    					<ul class="navbar-nav mr-auto" style="list-style-type: none;padding-top: 7%;">
								<li class="nav-item dropdown">
							        <a class="nav-link dropdown-toggle" href="{{ route('cand.dashboard') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							          <span style='color:white;text-transform: capitalize;'>Welcome {{ $candidate.',' }}</span>
							        </a>
							        <span style='color:white;' class="caret"></span>
							        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
							          
							          <a class="dropdown-item" href="{{ route('cand.dashboard') }}"><i class="ti-home"></i> Profile</a>
							          	<a href="{{ route('logout') }}" onclick="event.preventDefault();
																document.getElementById('logout-form').submit();"><i class="fa fa-sign-in"></i> Sign Out</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							          
							          <div class="dropdown-divider"></div>
							          	
							        </div>
						      	</li>
					       	</ul>
						  </div>
						@endif
						@if(isset($employer) && ($employer !== ''))						
							<!-- <li style="padding-top: 0.5rem;color:white;text-transform: capitalize;">
								<a href="{{ route('employer.dashboard') }}">									
									<span style='text-transform: capitalize;'>Welcome {{ $employer.',' }}</span>
								</a>
							</li>
							<li>  
								<a href="{{-- route('logout') --}}" onclick="event.preventDefault();
			                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-in"></i>Sign Out</a>
								<form id="logout-form" action="{{-- route('logout') --}}" method="POST" style="display: none;">
			                        @csrf
			                    </form>
							</li> -->
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    					<ul class="navbar-nav mr-auto" style="list-style-type: none;padding-top: 7%;">
									<li class="nav-item dropdown">
								        <a class="nav-link dropdown-toggle" href="{{ route('employer.dashboard') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								          <span style='color:white;text-transform: capitalize;'>Welcome {{ $employer.',' }}</span>
								        </a>
								        <span style='color:white;' class="caret"></span>
								        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
								          
								          <a class="dropdown-item" href="{{ route('employer.dashboard') }}"><i class="ti-home"></i> Profile</a>

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
						@if(!isset($candidate) && !isset($employer)) 
	                        <li class="left-br">
								<a href="{{ route('signin.index') }}" data-toggle="modal"  class="signin">Sign In Now</a>
								<!-- data-target="#signup" -->
							</li>
						@endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="dropdown">
							<a href="{{ route('homepage') }}" class="dropdown-toggle" data-toggle="dropdown">Home</a>
						</li>
						<li class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown">Jobs</a>
							<ul class="dropdown-menu animated fadeOutUp">
								<li><a href="">Compnay wise search</a></li>								
								<li><a href="">Job wise search</a></li>								
							</ul>
						</li>
						<li class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown">Brows</a>
							<ul class="dropdown-menu animated fadeOutUp">
								<li><a href="">Compnay</a></li>								
								<li><a href="">Job</a></li>
							</ul>
						</li>
						<!-- <li class="dropdown megamenu-fw"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Brows</a> -->

							<!-- <ul class="dropdown-menu megamenu-content" role="menu"> -->
								<!-- <li>
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
										</div>
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
										</div>end col-3
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
										</div>
									</div>
								</li> -->
							<!-- </ul> -->
						<!-- </li> -->
						@if(isset($employer) && ($employer !== ''))
						<li class="">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Candidate</a>
						</li>
						@endif
						<li class="">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us</a>
						</li>
						<li class="">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact Us</a>
						</li>
                    </ul>
                </div>
            </div>
        </nav>