@extends('layouts.app_afterLogin')

@section('content')
<?php
// echo '<pre>';
// print_r($candidate);
// exit;
?>
<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url({{ url('public/assets/img/banner-10.jpg') }}">
	<div class="container">
		<h1>Candidate Detail</h1>
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
						if($candidate[0]->profile_path == ''){?>
							<img src="{{ url('/public/empProfile/emp-default.png') }}" class="img-responsive" alt="company_logo" width="150" height="150" />
					<?php }else{
							$filename = $candidate[0]->profile_path;
							$url = url('/public/profile/'.$filename); 												
                	?>
                	<img src="{{ $url }}" class="img-responsive" alt="company_logo" width="150" height="150" />		
					<?php	} ?>
					
				</div>
				<div class="ur-caption">
					<h4 class="ur-title" style="text-transform: capitalize; padding-bottom: 2%">{{ $candidate[0]->name }}</h4>
					<p class="ur-location"><i class="ti-location-pin mrg-r-5"></i>{{ $candidate[0]->nationality }}</p>
					<p class="ur-location"><i class="ti-mobile mrg-r-5"></i>{{ $candidate[0]->phone_number }}</p>
					<span class="ur-designation"><i class="ti-email mrg-r-5"></i>{{ $candidate[0]->email }}</span>
				</div>				
			</div>

			<div class="ur-detail-btn">				
				<a href="{{ route('lists.appliedjob') }}" class="btn btn-warning mrg-bot-10 full-width"><i class="ti-angle-left	 mrg-r-5"></i>Back</a>
				<a href="{{ route('download.resume', $candidate[0]->id) }}" class="btn btn-info full-width"><i class="ti-download mrg-r-5"></i>Download Resume</a>
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
						<li><span>Date Of Birth(m-d-y):</span> {{ date('m-d-Y', strtotime($candidate[0]->dob)) }}</li>
						<li><span>Applied For:</span> {{ $candidate[0]->applied_for }}</li>
						<li><span>Experience</span> {{ $candidate[0]->experience_years.' Years'.$candidate[0]->experience_months.' Months' }}</li>
						<li><span>Available From(m-d-y):</span> {{ date('m-d-Y', strtotime($candidate[0]->availablefrom)) }}</li>
						<li style="text-transform: capitalize;"><span>Have USA Visa C1D?</span> {{ $candidate[0]->usavisa_c1d }}</li>
						<li><span>Competency Certificate:</span> {{ $candidate[0]->competency_certificate }}</li>
						<li><span>Currently Served As:</span> {{ $candidate[0]->last_vassel_served }}</li>
						<li><span>Vassel Size(in DWT):</span> {{ $candidate[0]->vassel_dwt }}</li>
						<li><span>Vassel Size(in GRT):</span> {{ $candidate[0]->vassel_grt }}</li>
					</ul>
				</div>
				@if($endorse)				
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Endorsement Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						
						@if(!empty($endorse[0]->endors_dec_chemical_dt))
						<li>{{ $endorse[0]->endors_name_dec_chemical }} : <?php echo isset($endorse[0]->endors_dec_chemical_dt) ?  date('m-d-Y', strtotime($endorse[0]->endors_dec_chemical_dt)) : '-'  ?></li>
						@endif
						@if(!empty($endorse[0]->endors_dec_gas_dt))
						<li>{{ $endorse[0]->endors_name_dec_gas }} : <?php echo isset($endorse[0]->endors_dec_gas_dt) ? date('m-d-Y', strtotime($endorse[0]->endors_dec_gas_dt)) : '-' ?> </li>
						@endif
						@if(!empty($endorse[0]->endors_dec_others_dt))
						<li>{{ $endorse[0]->endors_name_dec_others }} : <?php echo isset($endorse[0]->endors_dec_others_dt) ? date('m-d-Y', strtotime($endorse[0]->endors_dec_others_dt)) : '-'  ?></li>
						@endif
						@if(!empty($endorse[0]->endors_dec_petroleum_dt))						
						<li>{{ $endorse[0]->endors_name_dec_petroleum }} : <?php echo isset($endorse[0]->endors_dec_petroleum_dt) ? date('m-d-Y', strtotime($endorse[0]->endors_dec_petroleum_dt)) : '-'  ?></li>
						@endif
						@if(isset($endorse[0]->endors_others_dt))
						<li>{{ $endorse[0]->endors_name_others	 }} : <?php echo isset($endorse[0]->endors_others_dt) ? date('m-d-Y', strtotime($endorse[0]->endors_others_dt)) : '-'  ?></li>
						@endif
					</ul>
				</div>
				@endif
				<!-- Travel Documents -->
				@if($travel)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Travel Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						@if(!empty($travel[0]->passport_dt))
						<li>{{ $travel[0]->passport }} : <?php echo isset($travel[0]->passport_dt) ?  date('m-d-Y', strtotime($travel[0]->passport_dt)) : '-'  ?></li>
						@endif
						@if(!empty($travel[0]->Seamans_book_cdc_dt))
						<li>{{ $travel[0]->Seamans_book_cdc }} : <?php echo isset($travel[0]->Seamans_book_cdc_dt) ? date('m-d-Y', strtotime($travel[0]->Seamans_book_cdc_dt)) : '-' ?> </li>
						@endif
						@if(!empty($travel[0]->uk_work_permit_dt))
						<li>{{ $travel[0]->uk_work_permit }} : <?php echo isset($travel[0]->uk_work_permit_dt) ? date('m-d-Y', strtotime($travel[0]->uk_work_permit_dt)) : '-'  ?></li>
						@endif
						@if(!empty($travel[0]->us_visa_dt))
						<li>{{ $travel[0]->us_visa }} : <?php echo isset($travel[0]->us_visa_dt) ? date('m-d-Y', strtotime($travel[0]->us_visa_dt)) : '-'  ?></li>
						@endif
						@if(!empty($travel[0]->others_dt))
						<li>{{ $travel[0]->others	 }} : <?php echo isset($travel[0]->others_dt) ? date('m-d-Y', strtotime($travel[0]->others_dt)) : '-'  ?></li>
						@endif
					</ul>
				</div>
				@endif
				
				<!-- Medical Documents -->
				@if($medical)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">medical Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						@if(!empty($medical[0]->drug_alcohol_blood_test_dt))
						<li>{{ $medical[0]->drug_alcohol_blood_test }} : <?php echo isset($medical[0]->drug_alcohol_blood_test_dt) ?  date('m-d-Y', strtotime($medical[0]->drug_alcohol_blood_test_dt)) : '-'  ?></li>
						@endif
						@if(!empty($medical[0]->seafarers_medical_examination_dt))
						<li>{{ $medical[0]->Seamans_book_cdc }} : <?php echo isset($medical[0]->seafarers_medical_examination_dt) ? date('m-d-Y', strtotime($medical[0]->seafarers_medical_examination_dt)) : '-' ?> </li>
						@endif
						@if(!empty($medical[0]->ukooa_medical_fitness_dt))
						<li>{{ $medical[0]->ukooa_medical_fitness }} : <?php echo isset($medical[0]->ukooa_medical_fitness_dt) ? date('m-d-Y', strtotime($medical[0]->ukooa_medical_fitness_dt)) : '-'  ?></li>
						@endif
						@if(!empty($medical[0]->us_visa_dt))
						<li>{{ $medical[0]->ukooa_medical_fitness }} : <?php echo isset($medical[0]->ukooa_medical_fitness_dt) ? date('m-d-Y', strtotime($medical[0]->ukooa_medical_fitness_dt)) : '-'  ?></li>
						@endif
						@if(!empty($medical[0]->yellow_fever_vaccination_dt))
						<li>{{ $medical[0]->yellow_fever_vaccination	 }} : <?php echo isset($medical[0]->yellow_fever_vaccination_dt) ? date('m-d-Y', strtotime($medical[0]->yellow_fever_vaccination_dt)) : '-'  ?></li>
						@endif
						@if(!empty($medical[0]->medical_others_dt))
						<li>{{ $medical[0]->medical_others }} : <?php echo isset($medical[0]->medical_others_dt) ? date('m-d-Y', strtotime($medical[0]->medical_others_dt)) : '-'  ?></li>
						@endif
					</ul>
				</div>
				@endif

				<!-- skill_traing Documents -->
				@if($skill_traing)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Skill Training Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						@if(!empty($endorse[0]->passport_dt))
						<li>{{ $skill_traing[0]->arpa }} : <?php echo isset($skill_traing[0]->arpa_dt) ?  date('m-d-Y', strtotime($skill_traing[0]->passport_dt)) : '-'  ?></li>
						@endif
						@if(!empty($skill_traing[0]->behaviour_safety_process_dt))
						<li>{{ $skill_traing[0]->behaviour_safety_process }} : <?php echo isset($skill_traing[0]->behaviour_safety_process_dt) ? date('m-d-Y', strtotime($skill_traing[0]->behaviour_safety_process_dt)) : '-' ?> </li>
						@endif
						@if(!empty($skill_traing[0]->boatmaster_license_dt))
						<li>{{ $skill_traing[0]->boatmaster_license }} : <?php echo isset($skill_traing[0]->boatmaster_license_dt) ? date('m-d-Y', strtotime($skill_traing[0]->boatmaster_license_dt)) : '-'  ?></li>
						@endif
						@if(!empty($skill_traing[0]->bridge_team_management_dt))
						<li>{{ $skill_traing[0]->bridge_team_management }} : <?php echo isset($skill_traing[0]->bridge_team_management_dt) ? date('m-d-Y', strtotime($skill_traing[0]->bridge_team_management_dt)) : '-'  ?></li>
						@endif
						@if(!empty($skill_traing[0]->chemical_tankertraining_dt))
						<li>{{ $skill_traing[0]->chemical_tankertraining }} : <?php echo isset($skill_traing[0]->chemical_tankertraining_dt) ? date('m-d-Y', strtotime($skill_traing[0]->chemical_tankertraining_dt)) : '-'  ?></li>
						@endif
					</ul>
				</div>
				@endif

				<!-- personal Docs Documents -->
				@if($personal)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Personal Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						@if(!empty($personal[0]->driver_license_dt))
						<li>{{ $personal[0]->driver_license }} : <?php echo isset($personal[0]->driver_license_dt) ?  date('m-d-Y', strtotime($personal[0]->driver_license_dt)) : '-'  ?></li>
						@endif
						@if(!empty($personal[0]->photograph_dt))
						<li>{{ $personal[0]->photograph }} : <?php echo isset($personal[0]->photograph_dt) ? date('m-d-Y', strtotime($personal[0]->photograph_dt)) : '-' ?> </li>
						@endif
						@if(!empty($personal[0]->resume_dt))
						<li>{{ $personal[0]->resume }} : <?php echo isset($personal[0]->resume_dt) ? date('m-d-Y', strtotime($personal[0]->resume_dt)) : '-'  ?></li>
						@endif
						@if(!empty($personal[0]->personal_other_docs_dt))
						<li>{{ $personal[0]->personal_other_docs }} : <?php echo isset($personal[0]->personal_other_docs_dt) ? date('m-d-Y', strtotime($personal[0]->personal_other_docs_dt)) : '-'  ?></li>
						@endif
					</ul>
				</div>
				@endif

				<!-- COC Doc  -->
				@if($coc)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">COC Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						@if(!empty($coc[0]->officers_incharge_navigational_unlimited_dt))
						<li>{{ $coc[0]->officers_incharge_navigational_unlimited }} : <?php echo isset($coc[0]->officers_incharge_navigational_unlimited_dt) ?  date('m-d-Y', strtotime($coc[0]->officers_incharge_navigational_unlimited_dt)) : '-'  ?></li>
						@endif
						@if(!empty($coc[0]->master_unlimited_dt))
						<li>{{ $coc[0]->master_unlimited }} : <?php echo isset($coc[0]->master_unlimited_dt) ? date('m-d-Y', strtotime($coc[0]->master_unlimited_dt)) : '-' ?> </li>
						@endif
						@if(!empty($coc[0]->chief_mate_unlimited_dt))
						<li>{{ $coc[0]->chief_mate_unlimited }} : <?php echo isset($coc[0]->chief_mate_unlimited_dt) ? date('m-d-Y', strtotime($coc[0]->chief_mate_unlimited_dt)) : '-'  ?></li>
						@endif
						@if(!empty($coc[0]->masters_ships_lessthan_500gt_dt))
						<li>{{ $coc[0]->masters_ships_lessthan_500gt }} : <?php echo isset($coc[0]->masters_ships_lessthan_500gt_dt) ? date('m-d-Y', strtotime($coc[0]->masters_ships_lessthan_500gt_dt)) : '-'  ?></li>
						@endif
						@if(!empty($coc[0]->rating_forming_part_navigational_watch_dt))
						<li>{{ $coc[0]->rating_forming_part_navigational_watch }} : <?php echo isset($coc[0]->rating_forming_part_navigational_watch_dt) ?  date('m-d-Y', strtotime($coc[0]->rating_forming_part_navigational_watch_dt)) : '-'  ?></li>
						@endif
						@if(!empty($coc[0]->able_seafarer_deck_dt))
						<li>{{ $coc[0]->able_seafarer_deck }} : <?php echo isset($coc[0]->able_seafarer_deck_dt) ?  date('m-d-Y', strtotime($coc[0]->able_seafarer_deck_dt)) : '-'  ?></li>
						@endif
						@if(!empty($coc[0]->officer_charge_engineering_watch_dt))
						<li>{{ $coc[0]->officer_charge_engineering_watch }} : <?php echo isset($coc[0]->officer_charge_engineering_watch_dt) ?  date('m-d-Y', strtotime($coc[0]->officer_charge_engineering_watch_dt)) : '-'  ?></li>
						@endif
						@if(!empty($coc[0]->chief_engineer_officer_dt))
						<li>{{ $coc[0]->chief_engineer_officer }} : <?php echo isset($coc[0]->chief_engineer_officer_dt) ?  date('m-d-Y', strtotime($coc[0]->chief_engineer_officer_dt)) : '-'  ?></li>
						@endif
						@if(!empty($coc[0]->second_engineer_officer_dt))
						<li>{{ $coc[0]->second_engineer_officer }} : <?php echo isset($coc[0]->second_engineer_officer_dt) ?  date('m-d-Y', strtotime($coc[0]->second_engineer_officer_dt)) : '-'  ?></li>
						@endif
					</ul>
				</div>
				@endif

				<!-- stcw Docs Documents -->
				@if($stcw)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">STCW Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						@if(!empty($stcw[0]->basic_training_chemical_tc_operations_dt))
						<li>{{ $stcw[0]->basic_training_chemical_tc_operations }} : <?php echo isset($stcw[0]->basic_training_chemical_tc_operations_dt) ?  date('m-d-Y', strtotime($stcw[0]->basic_training_chemical_tc_operations_dt)) : '-'  ?></li>
						@endif
						@if(!empty($stcw[0]->advanced_tc_operations_dt))
						<li>{{ $stcw[0]->advanced_tc_operations }} : <?php echo isset($stcw[0]->advanced_tc_operations_dt) ? date('m-d-Y', strtotime($stcw[0]->advanced_tc_operations_dt)) : '-' ?> </li>
						@endif
						@if(!empty($stcw[0]->advanced_chemical_tc_operations_dt))
						<li>{{ $stcw[0]->advanced_chemical_tc_operations }} : <?php echo isset($stcw[0]->advanced_chemical_tc_operations_dt) ? date('m-d-Y', strtotime($stcw[0]->advanced_chemical_tc_operations_dt)) : '-'  ?></li>
						@endif
						@if(!empty($stcw[0]->bt_liquified_gas_tc_dt))
						<li>{{ $stcw[0]->bt_liquified_gas_tc }} : <?php echo isset($stcw[0]->bt_liquified_gas_tc_dt) ? date('m-d-Y', strtotime($stcw[0]->bt_liquified_gas_tc_dt)) : '-'  ?></li>
						@endif
						@if(!empty($stcw[0]->at_for_liquified_gas_tc_dt))
						<li>{{ $stcw[0]->at_for_liquified_gas_tc }} : <?php echo isset($stcw[0]->at_for_liquified_gas_tc_dt) ? date('m-d-Y', strtotime($stcw[0]->at_for_liquified_gas_tc_dt)) : '-'  ?></li>
						@endif
						@if(!empty($stcw[0]->crowd_mgt_training_dt))
						<li>{{ $stcw[0]->crowd_mgt_training }} : <?php echo isset($stcw[0]->crowd_mgt_training_dt) ? date('m-d-Y', strtotime($stcw[0]->crowd_mgt_training_dt)) : '-'  ?></li>
						@endif
						@if(!empty($stcw[0]->safety_training_for_personnel_providing_ds_dt))
						<li>{{ $stcw[0]->safety_training_for_personnel_providing_ds }} : <?php echo isset($stcw[0]->safety_training_for_personnel_providing_ds) ? date('m-d-Y', strtotime($stcw[0]->safety_training_for_personnel_providing_ds)) : '-'  ?></li>
						@endif

						@if(!empty($stcw[0]->crisis_mgt_human_behaviour_training_dt))
						<li>{{ $stcw[0]->crisis_mgt_human_behaviour_training }} : <?php echo isset($stcw[0]->crisis_mgt_human_behaviour_training_dt) ? date('m-d-Y', strtotime($stcw[0]->crisis_mgt_human_behaviour_training_dt)) : '-' ?> </li>
						@endif
						@if(!empty($stcw[0]->passenger_cargo_hull_integrity_training_dt))
						<li>{{ $stcw[0]->passenger_cargo_hull_integrity_training }} : <?php echo isset($stcw[0]->passenger_cargo_hull_integrity_training_dt) ? date('m-d-Y', strtotime($stcw[0]->passenger_cargo_hull_integrity_training_dt)) : '-' ?> </li>
						@endif
					</ul>
				</div>
				@endif

				<!-- offshore Docs Documents -->
				@if($offshore)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">offshore Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						@if(!empty($offshore[0]->agt0_dt))
						<li>{{ $offshore[0]->agt0 }} : <?php echo isset($offshore[0]->agt0_dt) ?  date('m-d-Y', strtotime($offshore[0]->agt0_dt)) : '-'  ?></li>
						@endif
						@if(!empty($offshore[0]->agtl1_cbt_dt))
						<li>{{ $offshore[0]->agtl1_cbt }} : <?php echo isset($offshore[0]->agtl1_cbt_dt) ? date('m-d-Y', strtotime($offshore[0]->agtl1_cbt_dt)) : '-' ?> </li>
						@endif
						@if(!empty($offshore[0]->agt2_dt))
						<li>{{ $offshore[0]->agt2 }} : <?php echo isset($offshore[0]->agt2_dt) ? date('m-d-Y', strtotime($offshore[0]->agt2_dt)) : '-'  ?></li>
						@endif
						@if(!empty($offshore[0]->agt2_cbt_dt))
						<li>{{ $offshore[0]->agt2_cbt }} : <?php echo isset($offshore[0]->agt2_cbt_dt) ? date('m-d-Y', strtotime($offshore[0]->agt2_cbt_dt)) : '-'  ?></li>
						@endif
						@if(!empty($offshore[0]->agt3_cbt_dt))
						<li>{{ $offshore[0]->agt3_cbt }} : <?php echo isset($offshore[0]->agt3_cbt_dt) ? date('m-d-Y', strtotime($offshore[0]->agt3_cbt_dt)) : '-'  ?></li>
						@endif
						@if(!empty($offshore[0]->ama_errv_crew_advanced_medical_aid_dt))
						<li>{{ $offshore[0]->ama_errv_crew_advanced_medical_aid }} : <?php echo isset($offshore[0]->ama_errv_crew_advanced_medical_aid_dt) ? date('m-d-Y', strtotime($offshore[0]->ama_errv_crew_advanced_medical_aid_dt)) : '-'  ?></li>
						@endif
						@if(!empty($offshore[0]->boat_travel_safely_by_boat_dt))
						<li>{{ $offshore[0]->boat_travel_safely_by_boat }} : <?php echo isset($offshore[0]->boat_travel_safely_by_boat_dt) ? date('m-d-Y', strtotime($offshore[0]->boat_travel_safely_by_boat_dt)) : '-'  ?></li>
						@endif
						@if(!empty($offshore[0]->boer_basic_onshore_emergency_response_dt))
						<li>{{ $offshore[0]->boer_basic_onshore_emergency_response }} : <?php echo isset($offshore[0]->boer_basic_onshore_emergency_response_dt) ? date('m-d-Y', strtotime($offshore[0]->boer_basic_onshore_emergency_response_dt)) : '-'  ?></li>
						@endif
						@if(!empty($offshore[0]->bosiet_with_ca_ebs_dt))
						<li>{{ $offshore[0]->bosiet_with_ca_ebs }} : <?php echo isset($offshore[0]->bosiet_with_ca_ebs_dt) ? date('m-d-Y', strtotime($offshore[0]->bosiet_with_ca_ebs_dt)) : '-'  ?></li>
						@endif
						@if(!empty($offshore[0]->bosiet_dt))
						<li>{{ $offshore[0]->bosiet }} : <?php echo isset($offshore[0]->bosiet_dt) ? date('m-d-Y', strtotime($offshore[0]->bosiet_dt)) : '-'  ?></li>
						@endif
					</ul>
				</div>
				@endif

				<!-- personal Docs Documents -->
				<?php
				// echo "<pre>";
				// print_r($yacht);
				?>
				@if($yacht)
				<div class="row row-bottom mrg-0">
					<h2 class="detail-title">Yacht Documents</h2>
					<ul class="job-detail-des">
						<li><b>Document Name: Document Expiry Date</b></li>
						@if(!empty($yacht[0]->advanced_powerboat_certificate_dt))
						<li>{{ $yacht[0]->advanced_powerboat_certificate }} : <?php echo isset($yacht[0]->advanced_powerboat_certificate_dt) ?  date('m-d-Y', strtotime($yacht[0]->advanced_powerboat_certificate_dt)) : '-'  ?></li>
						@endif
						@if(!empty($yacht[0]->basic_sea_survival_certificate_dt))
						<li>{{ $yacht[0]->basic_sea_survival_certificate }} : <?php echo isset($yacht[0]->basic_sea_survival_certificate_dt) ? date('m-d-Y', strtotime($yacht[0]->basic_sea_survival_certificate_dt)) : '-' ?> </li>
						@endif
						@if(!empty($yacht[0]->csy_offshore_certificate_dt))
						<li>{{ $yacht[0]->csy_offshore_certificate }} : <?php echo isset($yacht[0]->csy_offshore_certificate_dt) ? date('m-d-Y', strtotime($yacht[0]->csy_offshore_certificate_dt)) : '-'  ?></li>
						@endif
						@if(!empty($yacht[0]->ds_certificate_competence_dt))
						<li>{{ $yacht[0]->ds_certificate_competence }} : <?php echo isset($yacht[0]->ds_certificate_competence_dt) ? date('m-d-Y', strtotime($yacht[0]->ds_certificate_competence_dt)) : '-'  ?></li>
						@endif
						@if(!empty($yacht[0]->ds_shorebased_certificate_dt))
						<li>{{ $yacht[0]->ds_shorebased_certificate }} : <?php echo isset($yacht[0]->ds_shorebased_certificate_dt) ? date('m-d-Y', strtotime($yacht[0]->ds_shorebased_certificate_dt)) : '-'  ?></li>
						@endif
						@if(!empty($yacht[0]->diesel_engine_dt))
						<li>{{ $yacht[0]->diesel_engine }} : <?php echo isset($yacht[0]->diesel_engine_dt) ? date('m-d-Y', strtotime($yacht[0]->diesel_engine_dt)) : '-'  ?></li>
						@endif
						@if(!empty($yacht[0]->diveboat_coxswain_dt))
						<li>{{ $yacht[0]->diveboat_coxswain }} : <?php echo isset($yacht[0]->diveboat_coxswain_dt) ? date('m-d-Y', strtotime($yacht[0]->diveboat_coxswain_dt)) : '-'  ?></li>
						@endif
						@if(!empty($yacht[0]->diveboat_master_dt))
						<li>{{ $yacht[0]->diveboat_master }} : <?php echo isset($yacht[0]->diveboat_master_dt) ? date('m-d-Y', strtotime($yacht[0]->diveboat_master_dt)) : '-'  ?></li>
						@endif
						@if(!empty($yacht[0]->first_aid_dt))
						<li>{{ $yacht[0]->first_aid }} : <?php echo isset($yacht[0]->first_aid_dt) ? date('m-d-Y', strtotime($yacht[0]->first_aid_dt)) : '-'  ?></li>
						@endif
						@if(!empty($yacht[0]->international_pleasure_craft_certificate_dt))
						<li>{{ $yacht[0]->international_pleasure_craft_certificate }} : <?php echo isset($yacht[0]->international_pleasure_craft_certificate_dt) ? date('m-d-Y', strtotime($yacht[0]->international_pleasure_craft_certificate_dt)) : '-'  ?></li>
						@endif
					</ul>
				</div>
				@endif

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