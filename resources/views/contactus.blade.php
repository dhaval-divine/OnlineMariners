@extends('layouts.app_afterLogin')
<?php 
    // echo '<pre>';
    // print_r($allPostJobLists);
    // exit;
	$url = "'".url('/public/assets/img/banner-10.jpg')."'";
?>
@section('content')
<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url({{ $url }});">
	<div class="container">
		<h1>Contact Page</h1>
	</div>
</section>
<div class="clearfix"></div>
<!-- Title Header End -->

<!-- Contact Page Section Start -->
<section class="contact-page">
	<div class="container">
	<h2>Drop A Mail</h2>
	
		<div class="col-md-4 col-sm-4">
			<div class="contact-box">
				<i class="fa fa-map-marker"></i>
				<p>#Street 2122, Near New Market<br>London Uk (122546)</p>
			</div>
		</div>
		
		<div class="col-md-4 col-sm-4">
			<div class="contact-box">
				<i class="fa fa-envelope"></i>
				<p>careerdesk12@gmail.com<br>support@careerdesk.com</p>
			</div>
		</div>
		
		<div class="col-md-4 col-sm-4">
			<div class="contact-box">
				<i class="fa fa-phone"></i>
				<p>UK: 01 123 456 7895<br>Ind: +91 123 546 8758</p>
			</div>
		</div>
		
	</div>
</section>
<!-- contact section End -->

<!-- contact form -->
<section class="contact-form">
	<div class="container">
		<h2>Drop A Mail</h2>
		<form name="contact_us" action="" method="">
			<div class="col-md-6 col-sm-6">
				<input type="text" name="name" class="form-control" placeholder="Your Name">
			</div>
			
			<div class="col-md-6 col-sm-6">
				<input type="email" name="email" class="form-control" placeholder="Your Email">
			</div>
			
			<div class="col-md-6 col-sm-6">
				<input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
			</div>
			
			<div class="col-md-6 col-sm-6">
				<input type="text" name="subject" class="form-control" placeholder="Subject">
			</div>
			
			<div class="col-md-12 col-sm-12">
				<textarea class="form-control" name="message" placeholder="Message"></textarea>
			</div>
			
			<div class="col-md-12 col-sm-12">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</section>
<!-- Contact form End -->
@endsection