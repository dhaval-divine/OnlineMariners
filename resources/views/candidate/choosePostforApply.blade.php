@extends('layouts.app_afterLogin')

@section('content')
<?php	
	// echo 'after<pre>';
	// print_r($ranklists);
	// exit;
	// var_dump(($ranklists[0]->rank_position == $ranklists[0]->apply_rank));
	// exit;
	
	// echo $browsePostwageID;
	// exit;
?>
<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url({{ url('public/assets/img/banner-10.jpg') }}">
	<div class="container">
		<h1 style="text-transform: capitalize;">Select rank You want to apply</h1>
	</div>
</section>
<!-- <div class="clearfix"></div> -->
<!-- Title Header End -->
			
<!-- Candidate Detail Start -->
<section class="detail-desc">
	<div class="container">
	
		<div class="ur-detail-wrap top-lay">
			
			<div class="ur-detail-box">
				
				<div class="ur-thumb">

					<?php 
						$browsePostwageID = Request::segment(5);
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

			@if(isset($browsePostwageID))
			<div class="ur-detail-btn" style="padding-left: 2%;">
				<a href="{{ route('joblist.browse') }}" class="btn btn-info mrg-bot-10 full-width"><i class="ti-angle-left mrg-r-5"></i>Back</a>
			</div>
			@else			
			<div class="ur-detail-btn" style="padding-left: 2%;">
				<a href="{{ route('homepage') }}" class="btn btn-info mrg-bot-10 full-width"><i class="ti-angle-left mrg-r-5"></i>Back</a>
			</div>
			@endif
			
		</div>
		
	</div>
</section>

<!-- Job full detail Start -->
<section class="full-detail-description full-detail">
	<div class="container">
		<!-- Job Description -->
		<div class="col-md-12 col-sm-12">
			
			<div class="full-card90909">
				
				<div class="row" style="padding: 0% 0 6% 0">
					<div class="col-md-12  col-sm-12">
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
					<div class="col-lg-offset-2 col-lg-10">
						
						<form method="POST" action="{{ route('save.rank') }}">
	                        @csrf
	                        <input type="hidden" name="postjob_id" id="postjob_id" value="{{ $ranklists[0]->postjob_id }}">
	                        <input type="hidden" name="employer_id" id="employer_id" value="{{ $ranklists[0]->employer_id }}">
	                        @if(isset($browsePostwageID))
	                        	<input type="hidden" name="postwage_id" id="postwage_id" value="{{ $browsePostwageID }}">
	                        @else
	                        	<input type="hidden" name="postwage_id" id="postwage_id" value="">
	                        @endif
	                        <div class="row" style="padding: 4% 0 4% 0">
	                            <div class="col-lg-4 col-md-6 col-sm-12">
	                                <label style="padding: 6% 0 10% 0;font-size: 1.2em;">Choose Rank you want to apply for*</label>
	                            </div>
	                           
	                            <div class="">
	                                <div class="col-lg-5 col-md-6 col-sm-12">
	                                    <select name="rank_position" id="jb-type" class="rank_position">
	                                        <option value=''>Choose Rank you want to apply for</option>
		                                        @foreach($ranklists as  $rank)
											    <option value='{{ $rank->rank_position }}' 
											       <?php
											       	       
											       if(isset($rank->apply_rank)){
											       		if($rank->rank_position == $rank->apply_rank){
											       			echo 'disabled';
											       		}else{
											       			echo '';
											       		}
											       }
											       if(isset($rank->choose_rank)){
											       		if($rank->rank_position == $rank->choose_rank){
											       			echo 'selected';
											       		}else{
											       			echo '';
											       		}
											       }
											       ?>
											    >
											        	{{ $rank->rank_position }}</option>
											    @endforeach                            
	                                    </select>
	                                </div>                        
	                            </div>
	                        </div>

							<div class="form-groups col-lg-offset-3" style="max-width: 25%; text-align: center; ">
                            	<button type="submit" class="btn btn-primary theme-bg full-width" style="font-weight: bold;">Apply For Job</button>
                        	</div>
						</div>  
					</div>
				</div>
				
				
			</div>
		</div>
		
	</div>
</section>
<!-- Job full detail End -->


@endsection
@section('datepicker')
<script>
	

   $('.rank_position').change(function(){
	  var rank = $('.rank_position').val();
	  var postjob_id = $('#postjob_id').val();
	  var employer_id = $('#employer_id').val();
	  console.log(rank+' ' + postjob_id +' ' +employer_id);
	  // return false;
	  $.ajaxSetup({
	    headers: {
	      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	  });
	  $.ajax({
	    type:"POST",
	    url: "{{ route('job.data') }}",
	    data: { rank:rank, postjob_id:postjob_id, employer_id:employer_id},
	    success: function(data){
	    	var postwage_id = JSON.parse(data);
	    	$('#postwage_id').val(postwage_id);	      
	    }
	  })
	});
    
</script>

@endsection