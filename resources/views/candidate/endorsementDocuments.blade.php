@extends('layouts.app_afterLogin')
 
@section('content')
<?php

$return_tab = Session::get('return_tab');
    if($return_tab == '' || empty($return_tab)){        
        Session::forget('return_tab');
    }    
?>
<style type="text/css">
    .old_tab{
        background: #e7ecea !important;
        color: black !important;
    }
    .nav-tabs-custom>.nav-tabs>li:first-of-type {
        margin-left: 0;
    }
    .nav-tabs-custom>.nav-tabs>li.active {
        border-top-color: green;
    }
    .nav-tabs-custom>.nav-tabs>li {
        border-top: 3px solid transparent;
        margin-bottom: -2px;
        margin-right: 5px;
    }
    .nav-tabs-custom>.nav-tabs>li {
        border-top: 3px solid transparent;
        margin-bottom: -2px;
        margin-right: 5px;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
    .mand{
        color:red;
        font-weight: bold;
        font-size: 1.2em;
    }
    #endorse_table_wrapper .dataTables_length,#endorse_table_wrapper .dataTables_filter, #endorse_table_wrapper .dataTables_info,
    #endorse_table_wrapper .paging_simple_numbers {
        display: none;
    }
    #endorse_table_wrapper thead .sorting_asc , #endorse_table_wrapper .sorting{
        background-image: url('') !important;
    }
       
    #traveldoc_table_wrapper .dataTables_length, #traveldoc_table_filter, #traveldoc_table_info, #traveldoc_table_paginate{
        display: none;
    }
    #traveldoc_table_wrapper thead .sorting_asc , #traveldoc_table_wrapper .sorting{
        background-image: url('') !important;
    }
    #medicaldoc_table_wrapper .dataTables_length, #medicaldoc_table_filter, #medicaldoc_table_info, #medicaldoc_table_paginate{
        display: none;
    }
    #medicaldoc_table_wrapper thead .sorting_asc , #medicaldoc_table_wrapper .sorting{
        background-image: url('') !important;
    }
    #skill_trainingdoc_table_wrapper .dataTables_length, #skill_trainingdoc_table_filter, #skill_trainingdoc_table_info, #skill_trainingdoc_table_paginate{
        display: none;
    }
    
    #personaldoc_table_length, #personaldoc_table_filter, #personaldoc_table_info ,#personaldoc_table_filter{
        display: none;   
    }
</style>
<!-- General Detail Start -->
<section class="dashboard-wrap">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Wrap -->
            <div class="col-lg-3 col-md-4">
                <div class="side-dashboard">
                    <div class="dashboard-avatar">                                            
                        <div class="dashboard-avatar-thumb">                                
                            <?php     
                                // echo '<pre>';
                                // print_r($endors);
                                // exit;
                                foreach ($endors as $endors) {
                                    
                                }

                                $name = $profileimg[0]->profile_path;
                                $candidate_id = $profileimg[0]->id;
                                if($name == 'avatar-default.png'){
                                    $url = url('public/assets/img/avatar-default.png'); 
                                }else{
                                    $url = url('/public/profile/'.$name);
                                }  
                            ?>
                            @if(isset($name))
                            <img src="{{ $url }}" class="img-avater" alt="img-avater" />
                            @else
                            <img src="{{ url('public/assets/img/avatar-default.png') }}" class="img-avater" alt="img-avater1" />
                            @endif                                                           
                        </div>
                        <div class="dashboard-avatar-text">
                            <h4 style="text-transform: capitalize;">{{ Session::get('userName') }}</h4>
                        </div>                                                        
                    </div>
                    
                    <div class="dashboard-menu">
                        <ul>
                            <li><a href="{{ route('cand.dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a></li>
                            @if($profileimg[0]->candidate_status == 0)
                            <li><a href="{{ route('cand.profile') }}"><i class="ti-ruler-pencil"></i>Create Profile</a></li>
                            @endif
                            @if($profileimg[0]->candidate_status == 1)
                            <li><a href="{{ route('cand.edit') }}"><i class="ti-briefcase"></i>Update Profile</a></li>
                            
                            <li><a href="{{ route('cand.applylist') }}"><i class="ti-briefcase"></i>Job Applications</a></li>
                            <li class="active">
                                <a href="{{ route('endorsment.docs') }}"><i class="ti-briefcase"></i>Documents</a>
                            </li>  
                            @endif                          
                            <!-- <li><a href=""><i class="ti-user"></i>Applications</a></li>
                            <li><a href=""><i class="ti-wallet"></i>Packages</a></li>
                            <li><a href=""><i class="ti-cup"></i>Choose Packages</a></li>
                            <li><a href=""><i class="ti-flag-alt-2"></i>Viewed Resume</a></li>
                            <li><a href=""><i class="ti-id-badge"></i>Edit Profile</a></li>
                            <li><a href=""><i class="ti-power-off"></i>Logout</a></li> -->
                        </ul>
                        <!-- <h4>For Candidate</h4>
                        <ul>
                            <li><a href="candidate-dashboard.html"><i class="ti-dashboard"></i>Candidate Dashboard</a></li>
                            <li><a href="candidate-resume.html"><i class="ti-wallet"></i>My Resume</a></li>
                            <li><a href="applied-jobs.html"><i class="ti-hand-point-right"></i>Applied Jobs</a></li>
                            <li><a href="saved-jobs.html"><i class="ti-heart"></i>Saved Jobs</a></li>
                            <li><a href="alert-jobs.html"><i class="ti-bell"></i>Alert Jobs</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
            
            <!-- Content Wrap -->
            <div class="col-lg-9 col-md-8">
                <!-- Flash Msg on success-->
                <?php 
                    $return_tab = Session::get('return_tab'); 
                 ?>
                 <input type="hidden" value="{{ $return_tab }}" id="return_tab">
                @if( session('success') )
                    <div class="msg alert alert-success alert-dismissable fade in msg_diplay" style="margin: 1% 0;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <b>Success ! </b>{{ session('success') }}
                    </div>
                @endif
                <!-- Flash Msg on success-->
                @if( session('error') )
                    <div class="msg alert alert-danger alert-dismissable fade in msg_diplay" style="margin: 1% 0;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <b>Error ! </b>{{ session('error') }}
                    </div>
                @endif
               <div class="dashboard-body">
                    <div class="dashboard-caption">
                        
                        <div class="dashboard-caption-header">
                            <h4><i class="ti-briefcase"></i>Documents Expiry Date</h4>
                        </div>
                        
                        <div class="dashboard-caption-wrap">
                            <div style="padding-bottom: 3%;">
                                <!-- <b class='mand'>* Indidate Mandatory Fields</b> -->
                            </div>
                            <!-- <form name="endorse_form" method='POST' action="{{ route('endorsment.save') }}">
                                <div class="row">
                                    <div class="col-lg-2 col-md-6 col-sm-12 mrg-top-50">
                                        <div class="" style="margin-top: 10%">
                                            <p style="font-size: 1.5em; font-weight: bold;">Endorsements</p>
                                        </div>  
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">                                            
                                            <select id="jb-type" class="form-control select2-hidden-accessible" data-select2-id="jb-type" tabindex="-1" aria-hidden="true">
                                                <option value="">Select Document Type</option>
                                                <option value="DCE - Chemical">DCE - Chemical(Dangerous Cargo Endorsement)</option>
                                                <option value="DCE - Gas">DCE - Gas(Dangerous Cargo Endorsement)</option>
                                                <option value="DCE - Others">DCE - Others(Dangerous Cargo Endorsement)</option>
                                                <option value="DCE - Petroleum">DCE - Petroleum (Dangerous Cargo Endorsement)</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>  
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">                                            
                                            <input type="text" class="form-control" placeholder="EX. Month">
                                        </div>  
                                    </div>

                                    <div class="col-lg-2 col-md-6 col-sm-12 mrg-top-50">
                                        <div class="">
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save</button>
                                        </div>  
                                    </div>
                                    
                                </div>
                            </form> -->
                            <!-- Custom Tabs -->
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <!--1 Endorsements -->        
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Endorsements
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <form name="endorse_form" method='POST' action="{{ route('endorsment.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="endorse_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            DCE - Chemical(Dangerous Cargo Endorsement)
                                                            <input type="hidden" name="endors_name_dec_chemical" value="DCE - Chemical">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_chemical_require" class="rb_end_chemical_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_chemical_require"  class="rb_end_chemical_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_dec_chemical_dt" id="endors_dec_chemical_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_chemical_dt) ? date('m/d/Y', strtotime($endors->endors_dec_chemical_dt)) : '' }}">
                                                            
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            DCE - Gas(Dangerous Cargo Endorsement)
                                                            <input type="hidden" name="endors_name_dec_gas" value="DCE - Gas">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_gas_require" class="rb_end_dec_yes" class="rbhaveit"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_gas_require" class="rb_end_dec_no" class="rbhaveit" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_dec_gas_dt" id="endors_dec_gas_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_gas_dt) ? date('m/d/Y', strtotime($endors->endors_dec_gas_dt)) : '' }}" >
                                                            
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            DCE - Others(Dangerous Cargo Endorsement)
                                                            <input type="hidden" name="endors_name_dec_others" value="DCE - Others">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_others_require"  class="rb_end_deco_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_others_require"  class="rb_end_deco_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_dec_others_dt" id="endors_dec_others_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_others_dt) ? date('m/d/Y', strtotime($endors->endors_dec_others_dt)) : '' }}" >                                                           
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>DCE - Petroleum (Dangerous Cargo Endorsement)
                                                            <input type="hidden" name="endors_name_dec_petroleum" value="DCE - Petroleum">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_petroleum_require"  class="rb_edpt_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_petroleum_require" class="rb_edpt_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_dec_petroleum_dt" id="endors_dec_petroleum_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_petroleum_dt) ? date('m/d/Y', strtotime($endors->endors_dec_petroleum_dt)) : '' }}">
                                                        </td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Others
                                                            <input type="hidden" name="endors_name_others" value="Others">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_others_require"  class="rb_ed_other_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_others_require" class="rb_ed_other_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_others_dt" id="endors_others_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_others_dt) ? date('m/d/Y', strtotime($endors->endors_others_dt)) : '' }}">
                                                        </td>
                                                    </tr> -->                                    
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2-->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Travel Document
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                            <form name="endorse_form" method='POST' action="{{ route('traveldoc.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="traveldoc_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            Passport
                                                            <input type="hidden" name="passport" value="Passport">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="passport_dt_require"  class="rb_passport_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="passport_dt_require"  value="No" class="rb_passport_no" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="passport_dt" id="passport_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($travel[0]->passport_dt) ? date('m/d/Y', strtotime($travel[0]->passport_dt)) : '' }}">                                                            
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            Seaman's Book/CDC (Continuous Discharge Certificate)
                                                            <input type="hidden" name="Seamans_book_cdc" value="Seaman's Book/CDC">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="Seamans_book_cdc_require"  class="rb_semanbook_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="Seamans_book_cdc_require"  class="rb_semanbook_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="Seamans_book_cdc_dt" id="Seamans_book_cdc_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($travel[0]->Seamans_book_cdc_dt) ? date('m/d/Y', strtotime($travel[0]->Seamans_book_cdc_dt    )) : '' }}">                                                            
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            UK Work Permit
                                                            <input type="hidden" name="uk_work_permit" value="UK Work Permit">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="uk_work_permit_require" class="rb_ukpermit_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="uk_work_permit_require"  class="rb_ukpermit_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="uk_work_permit_dt" id="uk_work_permit_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($travel[0]->uk_work_permit_dt) ? date('m/d/Y', strtotime($travel[0]->uk_work_permit_dt    )) : '' }}" >                                                                
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            US Visa
                                                            <input type="hidden" name="us_visa" value="US Visa">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="us_visa_require" class="rb_usvisa_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="us_visa_require"  class="rb_usvisa_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="us_visa_dt" id="us_visa_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($travel[0]->us_visa_dt) ? date('m/d/Y', strtotime($travel[0]->us_visa_dt    )) : '' }}">                                                           
                                                        </td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Others
                                                            <input type="hidden" name="others" value="Others">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="others_dt"  value="Yes" class="rb_tra_other_yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="others_dt"  value="No" class="rb_tra_other_no" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="others_dt" id="others_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($travel[0]->others_dt) ? date('m/d/Y', strtotime($travel[0]->others_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>  -->                                   
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Medical Document
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <form name="medical_doc_form" method='POST' action="{{ route('medicaldoc.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="medicaldoc_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            Drug and Alcohol Test / Blood Test
                                                            <input type="hidden" name="drug_alcohol_blood_test" value="Drug and Alcohol Test / Blood Test">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="drug_alcoloh_test_require"  class="rb_drugtest_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="drug_alcoloh_test_require"  class="rb_drugtest_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="drug_alcohol_blood_test_dt" id="drug_alcohol_blood_test_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($medical[0]->drug_alcohol_blood_test_dt) ? date('m/d/Y', strtotime($medical[0]->drug_alcohol_blood_test_dt)) : '' }}">                                                            
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            Seafarer's Medical Examination
                                                            <input type="hidden" name="seafarers_medical_examination" value="Seafarer's Medical Examination">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="Seafarer_mediexa_require_require"  class="rb_seadrer_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="Seafarer_mediexa_require_require" class="rb_seadrer_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="seafarers_medical_examination_dt" id="seafarers_medical_examination_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($medical[0]->seafarers_medical_examination_dt) ? date('m/d/Y', strtotime($medical[0]->seafarers_medical_examination_dt)) : '' }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            UKOOA - Medical Fitness
                                                            <input type="hidden" name="ukooa_medical_fitness" value="UKOOA - Medical Fitness">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ukooa_medical_fitness_require"  class="rb_ukooa_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ukooa_medical_fitness_require"  class="rb_ukooa_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="ukooa_medical_fitness_dt" 
                                                            id="ukooa_medical_fitness_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($medical[0]->ukooa_medical_fitness_dt) ? date('m/d/Y', strtotime($medical[0]->ukooa_medical_fitness_dt)) : '' }}" >                                                                
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            Yellow Fever Vaccination
                                                            <input type="hidden" name="yellow_fever_vaccination" value="Yellow Fever Vaccination">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="yellow_fever_vaccination_require"  class="rb_yfever_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="yellow_fever_vaccination_require"  class="rb_yfever_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="yellow_fever_vaccination_dt" id="yellow_fever_vaccination_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($medical[0]->yellow_fever_vaccination_dt) ? date('m/d/Y', strtotime($medical[0]->yellow_fever_vaccination_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Others
                                                            <input type="hidden" name="others" value="others">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="medical_others_dt"  class="rb_mediother_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="medical_others_dt" class="rb_mediother_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="medical_others_dt" id="medical_others_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($medical[0]->others_dt) ? date('m/d/Y', strtotime($medical[0]->others_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr> -->                                    
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>

                                
                                <!-- 4 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">    
                                                Skills And Training Certificates
                                            </a>
                                        </h4>
                                    </div>

                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">
                                            <form name="skill_trainging_doc_form" method='POST' action="{{ route('skilldoc.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="skill_trainingdoc_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            ARPA
                                                            <input type="hidden" name="arpa" value="ARPA">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="arpa_require" class="rb_arpa_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="arpa_require"  class="rb_arpa_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="arpa_dt" id="arpa_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->arpa_dt) ? date('m/d/Y', strtotime($skill[0]->arpa_dt)) : '' }}">                                                            
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            Behaviour Based Safety Process
                                                            <input type="hidden" name="behaviour_safety_process" value="Behaviour Based Safety Process">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="behaviour_safety_process_require" class="rb_behaviour_safety_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="behaviour_safety_process_require" class="rb_behaviour_safety_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="behaviour_safety_process_dt" id="behaviour_safety_process_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->behaviour_safety_process_dt) ? date('m/d/Y', strtotime($skill[0]->behaviour_safety_process_dt)) : '' }}">                                                            
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            Boatmaster License
                                                            <input type="hidden" name="boatmaster_license" value="Boatmaster License">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="boatmaster_license_require" class="rb_boat_license_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="boatmaster_license_require" class="rb_boat_license_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="boatmaster_license_dt" id="boatmaster_license_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->boatmaster_license_dt) ? date('m/d/Y', strtotime($skill[0]->boatmaster_license_dt)) : '' }}" >                                                                
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            Bridge Team Management
                                                            <input type="hidden" name="bridge_team_management" value="Bridge Team Management">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="bridge_team_management_require" class="rb_bridgeteam_mgt_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="bridge_team_management_require" class="rb_bridgeteam_mgt_no"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="bridge_team_management_dt" id="bridge_team_management_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->bridge_team_management_dt) ? date('m/d/Y', strtotime($skill[0]->bridge_team_management_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Chemical Tanker Training
                                                            <input type="hidden" name="chemical_tankertraining" value="Chemical Tanker Training">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="chemical_tankertraining_require" class="rb_chemical_tank_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="chemical_tankertraining_require" class="rb_chemical_tank_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="chemical_tankertraining_dt" id="chemical_tankertraining_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->chemical_tankertraining_dt) ? date('m/d/Y', strtotime($skill[0]->chemical_tankertraining_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>
                                                            COWS - Crude Oil Washing
                                                            <input type="hidden" name="cows_crudeoil_washing" value="COWS - Crude Oil Washing">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="cows_crudeoil_washing_require" class="rb_cows_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="cows_crudeoil_washing_require" class="rb_cows_no"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cows_crudeoil_washing_dt" id="cows_crudeoil_washing_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->cows_crudeoil_washing_dt) ? date('m/d/Y', strtotime($skill[0]->cows_crudeoil_washing_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>
                                                            Crane Operator Certificate
                                                            <input type="hidden" name="crane_operator_certificate" value="Crane Operator Certificate">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="crane_operator_certificate_require" class="rb_crencerti_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="crane_operator_certificate_require" class="rb_crencerti_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="crane_operator_certificate_dt" id="crane_operator_certificate_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->crane_operator_certificate_dt) ? date('m/d/Y', strtotime($skill[0]->crane_operator_certificate_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>
                                                            DP - Induction
                                                            <input type="hidden" name="dp_induction" value="DP - Induction">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="dp_induction_require"  class="rb_dpinduction_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="dp_induction_require" class="rb_dpinduction_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="dp_induction_dt" id="dp_induction_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->dp_induction_dt) ? date('m/d/Y', strtotime($skill[0]->dp_induction_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>
                                                            DP - Limited
                                                            <input type="hidden" name="dp_limited" value="DP - Limited">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="dp_limited_require" class="rb_dplimited_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="dp_limited_require" class="rb_dplimited_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="dp_limited_dt" id="dp_limited_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->dp_limited_dt) ? date('m/d/Y', strtotime($skill[0]->dp_limited_dt)) : '' }}">     
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>
                                                            DP - Simulator
                                                            <input type="hidden" name="dp_simulator" value="DP - Simulator">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="dp_simulator_require"  class="rb_dpsimulator_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="dp_simulator_require"  class="rb_dpsimulator_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="dp_simulator_dt" id="dp_simulator_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->dp_simulator_dt) ? date('m/d/Y', strtotime($skill[0]->dp_simulator_dt)) : '' }}">     
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>
                                                            DP - Full
                                                            <input type="hidden" name="dp_full" value="DP - Full">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="others_dt"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="others_dt"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="dp_full_dt" id="dp_full_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->dp_full_dt) ? date('m/d/Y', strtotime($skill[0]->dp_full_dt)) : '' }}">     
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>12</td>
                                                        <td>
                                                            DP Maintenance
                                                            <input type="hidden" name="others" value="DP Maintenance">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="dp_maintenance_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="dp_maintenance_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="dp_maintenance_dt" id="dp_maintenance_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->dp_maintenance_dt) ? date('m/d/Y', strtotime($skill[0]->dp_maintenance_dt)) : '' }}">     
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>13</td>
                                                        <td>
                                                            ECDIS
                                                            <input type="hidden" name="ecdis" value="ECDIS">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ecdis_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ecdis_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="ecdis_dt" id="ecdis_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->ecdis_dt) ? date('m/d/Y', strtotime($skill[0]->ecdis_dt)) : '' }}">     
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>14</td>
                                                        <td>
                                                            ECDIS KH
                                                            <input type="hidden" name="ecdis_kh" value="ECDIS KH">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="others_dt"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="others_dt"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="ecdis_kh_dt" id="ecdis_kh_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->ecdis_kh_dt) ? date('m/d/Y', strtotime($skill[0]->ecdis_kh_dt)) : '' }}">     
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>15</td>
                                                        <td>
                                                            Engineroom Systems Management
                                                            <input type="hidden" name="engineroom_simulator" value="Engineroom Systems Management">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="engineroom_simulator_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="engineroom_simulator_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="engineroom_simulator_dt" id="engineroom_simulator_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->engineroom_simulator_dt) ? date('m/d/Y', strtotime($skill[0]->engineroom_simulator_dt)) : '' }}">     
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>16</td>
                                                        <td>
                                                            Engineroom Simulator Course
                                                            <input type="hidden" name="engineroom_simulator_course" value="Engineroom Simulator Course">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="engineroom_simulator_course_dt"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="engineroom_simulator_course_dt"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="engineroom_simulator_course_dt" id="engineroom_simulator_course_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($skill[0]->engineroom_simulator_course_dt) ? date('m/d/Y', strtotime($skill[0]->engineroom_simulator_course_dt)) : '' }}">     
                                                        </td>
                                                    </tr>                                                    
                                                </tbody>
                                                
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- 5-->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFive">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> 
                                                Personal Document
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                        <div class="panel-body">
                                            <form name="personal_doc_form" method='POST' action="{{ route('personaldoc.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="personaldoc_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            Driver License
                                                            <input type="hidden" name="driver_license" value="Driver License">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> 
                                                                    <input type="radio" name="driver_license_require"  class="rb_driver_lice_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="driver_license_require" class="rb_driver_lice_no"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="driver_license_dt" id="driver_license_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($personal[0]->driver_license_dt) ? date('m/d/Y', strtotime($personal[0]->driver_license_dt)) : '' }}">                                                            
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            Photograph
                                                            <input type="hidden" name="photograph" value="Photograph">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="photograph_require" class="rb_photograph_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="photograph_require" class="rb_photograph_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="photograph_dt" id="photograph_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($personal[0]->photograph_dt) ? date('m/d/Y', strtotime($personal[0]->photograph_dt)) : '' }}">                                                            
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            Resume
                                                            <input type="hidden" name="resume" value="Resume">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="resume_require" class="rb_resume_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="resume_require" class="rb_resume_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="resume_dt" id="resume_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($personal[0]->resume_dt) ? date('m/d/Y', strtotime($personal[0]->resume_dt)) : '' }}" >                                                                
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            Peronsal Other
                                                            <input type="hidden" name="personal_other_docs" value="Peronsal Other">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="personal_other_docs_require" class="rb_per_otherdocs_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="personal_other_docs_require" class="rb_per_otherdocs_no" value="No" checked> No </label>
                                                            </div>  
                                                        </td>
                                                        <td>
                                                            <input type="text" name="personal_other_docs_dt" id="personal_other_docs_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($personal[0]->personal_other_docs_dt) ? date('m/d/Y', strtotime($personal[0]->personal_other_docs_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                                                      
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>

                                <!--6 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingSix">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                COC
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                        <div class="panel-body">
                                            <form name="cocdoc_form" method='POST' action="{{ route('cocDocs.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="coc_doc_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            Officers In Charge of a Navigational Watch
                                                            <input type="hidden" name="officers_incharge_navigational_unlimited" value="Officers In Charge of a Navigational Watch">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="officers_incharge_navigational_unlimited_require" class="rb_officer_nav_watch_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="officers_incharge_navigational_unlimited_require"  class="rb_officer_nav_watch_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="officers_incharge_navigational_unlimited_dt" id="officers_incharge_navigational_unlimited_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->officers_incharge_navigational_unlimited_dt) ? date('m/d/Y', strtotime($coc[0]->officers_incharge_navigational_unlimited_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            Master Unlimited
                                                            <input type="hidden" name="master_unlimited" value="Master Unlimited">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="master_unlimited_require" class="rb_masunlimit_yes value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="master_unlimited_require" class="rb_masunlimit_no"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="master_unlimited_dt" id="master_unlimited_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->master_unlimited_dt) ? date('m/d/Y', strtotime($coc[0]->master_unlimited_dt)) : '' }}">                                                            
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            Chief Mate Unlimited
                                                            <input type="hidden" name="chief_mate_unlimited" value="Chief Mate Unlimited">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="chief_mate_unlimited_require" class="rb_cmateunli_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="chief_mate_unlimited_require"  class="rb_cmateunli_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="chief_mate_unlimited_dt" id="chief_mate_unlimited_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->chief_mate_unlimited_dt) ? date('m/d/Y', strtotime($coc[0]->chief_mate_unlimited_dt)) : '' }}" >                                                                
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            Masters On Ships Of Less Than 500 Gross Tonnage
                                                            <input type="hidden" name="masters_ships_lessthan_500gt" value="Masters On Ships Of Less Than 500 Gross Tonnage, Near Coastal">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="masters_ships_lessthan_500gt_require"  class="rb_mshiogre500_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="masters_ships_lessthan_500gt_require"  class="rb_mshiogre500_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="masters_ships_lessthan_500gt_dt" id="masters_ships_lessthan_500gt_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->masters_ships_lessthan_500gt_dt) ? date('m/d/Y', strtotime($coc[0]->masters_ships_lessthan_500gt_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Officers In Charge of a Navigational Watch on Ships of Less Than 500 Gross Tonnage
                                                            <input type="hidden" name="officers_charge_navigational_less_500" value="Officers In Charge of a Navigational Watch on Ships of Less Than 500 Gross Tonnage">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="officers_charge_navigational_less_500_require"  class="rb_navofficer500_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="officers_charge_navigational_less_500_require" class="rb_navofficer500_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="officers_charge_navigational_less_500_dt" id="officers_charge_navigational_less_500_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->officers_charge_navigational_less_500_dt) ? date('m/d/Y', strtotime($coc[0]->masters_ships_lessthan_500gt_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>
                                                            Rating Forming Part Of A Navigational Watch
                                                            <input type="hidden" name="rating_forming_part_navigational_watch" value="Rating Forming Part Of A Navigational Watch">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="rating_forming_part_navigational_watch_require"  class="rb_ratingnavwatch_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="rating_forming_part_navigational_watch_require" class="rb_ratingnavwatch_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="rating_forming_part_navigational_watch_dt" id="rating_forming_part_navigational_watch_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->rating_forming_part_navigational_watch_dt) ? date('m/d/Y', strtotime($coc[0]->rating_forming_part_navigational_watch_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>
                                                            Able Seafarer Deck
                                                            <input type="hidden" name="able_seafarer_deck" value="Able Seafarer Deck">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="able_seafarer_deck_require" class="rb_ablsererd_yes" value="Yes"> Yes </label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="able_seafarer_deck_require" class="rb_ablsererd_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="able_seafarer_deck_dt" id="able_seafarer_deck_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->able_seafarer_deck_dt) ? date('m/d/Y', strtotime($coc[0]->able_seafarer_deck_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>
                                                            Officer In Charge Of An Engineering Watch
                                                            <input type="hidden" name="officer_charge_engineering_watch" value="Officer In Charge Of An Engineering Watch">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="officer_charge_engineering_watch_require" class="rb_offwatchin_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="officer_charge_engineering_watch_require" class="rb_offwatchin_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="officer_charge_engineering_watch_dt" id="officer_charge_engineering_watch_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->officer_charge_engineering_watch_dt) ? date('m/d/Y', strtotime($coc[0]->officer_charge_engineering_watch_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>
                                                            Chief Engineer Officer
                                                            <input type="hidden" name="chief_engineer_officer" value="Chief Engineer Officer">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="chief_engineer_officer_require" class="rb_chiefEO_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="chief_engineer_officer_require" class="rb_chiefEO_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="chief_engineer_officer_dt" id="chief_engineer_officer_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->chief_engineer_officer_dt) ? date('m/d/Y', strtotime($coc[0]->chief_engineer_officer_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>
                                                            Second Engineer Officer
                                                            <input type="hidden" name="second_engineer_officer" value="Second Engineer Officer">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="second_engineer_officer_require" class="rb_secEO_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="second_engineer_officer_require" class="rb_secEO_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="second_engineer_officer_dt" id="second_engineer_officer_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($coc[0]->second_engineer_officer_dt) ? date('m/d/Y', strtotime($coc[0]->second_engineer_officer_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>

                                <!--7 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingSeven">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                STCW
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                        <div class="panel-body">
                                            <form name="stcwdoc_form" method='POST' action="{{ route('stcwdoc.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="stcw_doc_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            Basic Training for Oil and Chemical Tanker Cargo Operations
                                                            <input type="hidden" name="basic_training_chemical_tc_operations" value="Basic Training for Oil and Chemical Tanker Cargo Operations">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="basic_training_chemical_tc_operations_require" class="rb_btchemitcopr_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="basic_training_chemical_tc_operations_require" class="rb_btchemitcopr_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="basic_training_chemical_tc_operations_dt" id="basic_training_chemical_tc_operations_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->basic_training_chemical_tc_operations_dt) ? date('m/d/Y', strtotime($stcw[0]->basic_training_chemical_tc_operations_dt)) : '' }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            Advanced Training for Oil Tanker Cargo Operations
                                                            <input type="hidden" name="advanced_tc_operations" value="Advanced Training for Oil Tanker Cargo Operations">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="advanced_tc_operations_require" class="rb_atfocaropr_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="advanced_tc_operations_require" class="rb_atfocaropr_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="advanced_tc_operations_dt" id="advanced_tc_operations_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->advanced_tc_operations_dt) ? date('m/d/Y', strtotime($stcw[0]->advanced_tc_operations_dt)) : '' }}">                   
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            Advanced Training for Chemical Tanker Cargo Operations
                                                            <input type="hidden" name="advanced_chemical_tc_operations" value="Advanced Training for Chemical Tanker Cargo Operations">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="advanced_chemical_tc_operations_require" class="rb_atfortco_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="advanced_chemical_tc_operations_require" class="rb_atfortco_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="advanced_chemical_tc_operations_dt" id="advanced_chemical_tc_operations_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->advanced_chemical_tc_operations_dt) ? date('m/d/Y', strtotime($stcw[0]->advanced_chemical_tc_operations_dt)) : '' }}" >                                                                
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            Basic Training for Liquified Gas Tanker Cargo
                                                            <input type="hidden" name="bt_liquified_gas_tc" value="Basic Training for Liquified Gas Tanker Cargo">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="bt_liquified_gas_tc_require" class="rb_liquidgsc_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="bt_liquified_gas_tc_require" class="rb_liquidgsc_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="bt_liquified_gas_tc_dt" id="bt_liquified_gas_tc_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->bt_liquified_gas_tc_dt) ? date('m/d/Y', strtotime($stcw[0]->bt_liquified_gas_tc_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Advanced Training for Liquified Gas Tanker Cargo
                                                            <input type="hidden" name="at_for_liquified_gas_tc" value="Advanced Training for Liquified Gas Tanker Cargo">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="at_for_liquified_gas_tc_require" class="rb_atflgasc_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="at_for_liquified_gas_tc_require" class="rb_atflgasc_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="at_for_liquified_gas_tc_dt" id="at_for_liquified_gas_tc_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->at_for_liquified_gas_tc_dt) ? date('m/d/Y', strtotime($stcw[0]->at_for_liquified_gas_tc_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>
                                                            Crowd Managemnet Training
                                                            <input type="hidden" name="crowd_mgt_training" value="Crowd Managemnet Training">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="crowd_mgt_training_require" class="rb_cmgttra_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="crowd_mgt_training_require" class="rb_cmgttra_yes" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="crowd_mgt_training_dt" id="crowd_mgt_training_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->crowd_mgt_training_dt) ? date('m/d/Y', strtotime($stcw[0]->crowd_mgt_training_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>
                                                            Safety Training for Personnel Providing Direct Service to Passengers in Passenger Spaces
                                                            <input type="hidden" name="safety_training_for_personnel_providing_ds" value="Safety Training for Personnel Providing Direct Service to Passengers in Passenger Spaces">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="safety_training_for_personnel_providing_ds_require" class="rb_safetpdstopp_yes" value="Yes"> Yes </label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="safety_training_for_personnel_providing_ds_require" class="rb_safetpdstopp_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="safety_training_for_personnel_providing_ds_dt" id="safety_training_for_personnel_providing_ds_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->safety_training_for_personnel_providing_ds_dt) ? date('m/d/Y', strtotime($stcw[0]->safety_training_for_personnel_providing_ds_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>
                                                            Crisis Management and Human Behaviour Training
                                                            <input type="hidden" name="crisis_mgt_human_behaviour_training" value="Crisis Management and Human Behaviour Training">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="crisis_mgt_human_behaviour_training_require" class="rb_cmgtht_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="crisis_mgt_human_behaviour_training_require" class="rb_cmgtht_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="crisis_mgt_human_behaviour_training_dt" id="crisis_mgt_human_behaviour_training_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->crisis_mgt_human_behaviour_training_dt) ? date('m/d/Y', strtotime($stcw[0]->crisis_mgt_human_behaviour_training_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>
                                                            Passenger Safety, Cargo Safety and Hull Integrity Training
                                                            <input type="hidden" name="passenger_cargo_hull_integrity_training" value="Passenger Safety, Cargo Safety and Hull Integrity Training">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="passenger_cargo_passenger_cargo_hull_integrity_training_require" class="rb_hullinte_cs_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="passenger_cargo_passenger_cargo_hull_integrity_training_require"  class="rb_hullinte_cs_no" value="No"  checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="passenger_cargo_hull_integrity_training_dt" id="passenger_cargo_hull_integrity_training_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->passenger_cargo_hull_integrity_training_dt) ? date('m/d/Y', strtotime($stcw[0]->passenger_cargo_hull_integrity_training_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>
                                                            Basic Safety Training Certificate
                                                            <input type="hidden" name="basic_safety_tc" value="Basic Safety Training Certificate">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="basic_safety_tc_require" class="rb_basicstc_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="basic_safety_tc_require" class="rb_basicstc_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="basic_safety_tc_dt" id="basic_safety_tc_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($stcw[0]->basic_safety_tc_dt) ? date('m/d/Y', strtotime($stcw[0]->basic_safety_tc_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
 
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>

                                <!--8 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingEight">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                Offshore Certification
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                        <div class="panel-body">
                                           <form name="offshore_form" method='POST' action="{{ route('Offshoredoc.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="offshore_doc_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            AGT0- Authorised Gas Tester Training Level 1
                                                            <input type="hidden" name="agt0" value="AGT0- Authorised Gas Tester Training Level 1">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agt0_dt_require" class="rb_AGT0_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agt0_dt_require" class="rb_AGT0_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="agt0_dt" id="agt0_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->agt0_dt) ? date('m/d/Y', strtotime($offshore[0]->agt0_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            AGT1 (CBT)- Authorised Gas Tester Training Level 1 (CBT) 
                                                            <input type="hidden" name="agtl1_cbt" value="AGT1 (CBT)- Authorised Gas Tester Training Level 1 (CBT)">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agtl1_cbt_require" class="rb_AGT1_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agtl1_cbt_require" class="rb_AGT2_yes" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="agtl1_cbt_dt" id="agtl1_cbt_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->agtl1_cbt_dt) ? date('m/d/Y', strtotime($offshore[0]->agtl1_cbt_dt)) : '' }}">                                                            
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            AGT1- Authorised Gas Tester Training Level 2
                                                            <input type="hidden" name="agt2" value="Advanced Training for Chemical Tanker Cargo Operations">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agt2_require" class="rb_AGT1agtl2_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agt2_require" class="rb_AGT1agtl2_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="agt2_dt" id="agt2_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->agt2_dt) ? date('m/d/Y', strtotime($offshore[0]->agt2_dt)) : '' }}" >                                                                
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            AGT2 (CBT)- Authorised Gas Tester Training Level 2 (CBT)
                                                            <input type="hidden" name="agt2_cbt" value="AGT2 (CBT)- Authorised Gas Tester Training Level 2 (CBT)">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agt2_cbt_require" class="rb_AGT1cbtagttl2_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agt2_cbt_require" class="rb_AGT1cbtagttl2_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="agt2_cbt_dt" id="agt2_cbt_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->agt2_cbt_dt) ? date('m/d/Y', strtotime($offshore[0]->agt2_cbt_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                            AGT3 (CBT)- Authorised Gas Tester Training Level 3 (CBT)
                                                            <input type="hidden" name="agt3_cbt" value="AGT2- Authorised Gas Tester Training Level 3">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agt3_cbt_require" class="rb_AGT3agttl3_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="agt3_cbt_require" class="rb_AGT3agttl3_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="agt3_cbt_dt" id="agt3_cbt_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->agt3_cbt_dt) ? date('m/d/Y', strtotime($offshore[0]->agt3_cbt_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>
                                                            AMA-ERRV Crew Advanced Medical Aid
                                                            <input type="hidden" name="ama_errv_crew_advanced_medical_aid" value="AMA-ERRV Crew Advanced Medical Aid">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ama_errv_crew_advanced_medical_aid_require" class="rb_amaerrvmaid_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ama_errv_crew_advanced_medical_aid_require" class="rb_amaerrvmaid_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="ama_errv_crew_advanced_medical_aid_dt" id="ama_errv_crew_advanced_medical_aid_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->ama_errv_crew_advanced_medical_aid_dt) ? date('m/d/Y', strtotime($offshore[0]->ama_errv_crew_advanced_medical_aid_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>
                                                            BOAT- Travel Safely by Boat
                                                            <input type="hidden" name="boat_travel_safely_by_boat" value="BOAT- Travel Safely by Boat">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="boat_travel_safely_by_boat_require" class="rb_boattsboat_yes" value="Yes"> Yes </label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="boat_travel_safely_by_boat_require" class="rb_boattsboat_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="boat_travel_safely_by_boat_dt" id="boat_travel_safely_by_boat_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->boat_travel_safely_by_boat_dt) ? date('m/d/Y', strtotime($offshore[0]->boat_travel_safely_by_boat_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>
                                                            BOER- Basic Onshore Emergency Response
                                                            <input type="hidden" name="boer_basic_onshore_emergency_response" value="BOER- Basic Onshore Emergency Response">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="boer_basic_onshore_emergency_response_require" class="rb_boer_yes"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="boer_basic_onshore_emergency_response_require" class="rb_boer_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="boer_basic_onshore_emergency_response_dt" id="boer_basic_onshore_emergency_response_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->boer_basic_onshore_emergency_response_dt) ? date('m/d/Y', strtotime($offshore[0]->boer_basic_onshore_emergency_response_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>
                                                            BOSIET (with CA-EBS)- Basic Offshore Safety Induction and Emergency Training (with CA-EBS)
                                                            <input type="hidden" name="bosiet_with_ca_ebs" value="BOSIET (with CA-EBS)- Basic Offshore Safety Induction and Emergency Training (with CA-EBS)">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="bosiet_with_ca_ebs_require" class="rb_bosiet_caebs_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="bosiet_with_ca_ebs_require" class="rb_bosiet_caebs_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="bosiet_with_ca_ebs_dt" id="bosiet_with_ca_ebs_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->bosiet_with_ca_ebs_dt) ? date('m/d/Y', strtotime($offshore[0]->bosiet_with_ca_ebs_dt)) : '' }}"> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>
                                                            BOSIET- Basic Offshore Safety Induction and Emergency Training 
                                                            <input type="hidden" name="bosiet" value="BOSIET- Basic Offshore Safety Induction and Emergency Training">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="bosiet_require" class="rb_bosietet_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="bosiet_require" class="rb_bosietet_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="bosiet_dt" id="bosiet_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($offshore[0]->bosiet_dt) ? date('m/d/Y', strtotime($offshore[0]->bosiet_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    // echo "<pre>";
                                    // print_r($stcw_tab);
                                    // exit;
                                ?>
                                <!-- 9 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingNine">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                                
                                                Yacht Certification
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                                        <div class="panel-body">
                                            <form name="yacht_form" method='POST' action="{{ route('yachtdoc.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="yacht_doc_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            Advanced Powerboat Certificate Of Competence
                                                            <input type="hidden" name="advanced_powerboat_certificate" value="Advanced Powerboat Certificate Of Competence">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="advanced_powerboat_certificate_require" class="rb_advpowc_yes" value="Yes"> Yes </label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="advanced_powerboat_certificate_require" class="rb_advpowc_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="advanced_powerboat_certificate_dt" id="advanced_powerboat_certificate_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->advanced_powerboat_certificate_dt) ? date('m/d/Y', strtotime($yacht[0]->advanced_powerboat_certificate_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            Basic Sea Survival Certificate
                                                            <input type="hidden" name="basic_sea_survival_certificate" value="Basic Sea Survival Certificate">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="basic_sea_survival_certificate_require" class="rb_seaservival_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="basic_sea_survival_certificate_require" class="rb_seaservival_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="basic_sea_survival_certificate_dt" id="basic_sea_survival_certificate_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->basic_sea_survival_certificate_dt) ? date('m/d/Y', strtotime($yacht[0]->basic_sea_survival_certificate_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            Coastal Skipper / Yachtmaster Offshore Shorebased Certificate
                                                            <input type="hidden" name="csy_offshore_certificate" value="Coastal Skipper / Yachtmaster Offshore Shorebased Certificate">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="csy_offshore_certificate_require" class="rb_costyoffsc_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="csy_offshore_certificate_require" class="rb_costyoffsc_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="csy_offshore_certificate_dt" id="csy_offshore_certificate_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->csy_offshore_certificate_dt) ? date('m/d/Y', strtotime($yacht[0]->csy_offshore_certificate_dt)) : '' }}" >                                                                
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            Day Skipper Certificate of Competence
                                                            <input type="hidden" name="ds_certificate_competence" value="Day Skipper Certificate of Competence">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ds_certificate_competence_require"  class="rb_datskipcom_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ds_certificate_competence_require"  class="rb_datskipcom_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="ds_certificate_competence_dt" id="ds_certificate_competence_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->ds_certificate_competence_dt) ? date('m/d/Y', strtotime($yacht[0]->ds_certificate_competence_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Day Skipper Shorebased Certificate
                                                            <input type="hidden" name="ds_shorebased_certificate" value="Day Skipper Shorebased Certificate">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ds_shorebased_certificate_require"  class="rb_dskshorebase_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="ds_shorebased_certificate_require"  class="rb_dskshorebase_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="ds_shorebased_certificate_dt" id="ds_shorebased_certificate_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->ds_shorebased_certificate_dt) ? date('m/d/Y', strtotime($yacht[0]->ds_shorebased_certificate_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>
                                                            Diesel Engine
                                                            <input type="hidden" name="diesel_engine" value="Diesel Engine">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="diesel_engine_require"  class="rb_dieselegine_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="diesel_engine_require"  class="rb_dieselegine_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="diesel_engine_dt" id="diesel_engine_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->diesel_engine_dt) ? date('m/d/Y', strtotime($yacht[0]->diesel_engine_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>
                                                            Diveboat Coxswain
                                                            <input type="hidden" name="diveboat_coxswain" value="Diveboat Coxswain">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="diveboat_coxswain_require"  class="rb_divecoxsw_yes" value="Yes"> Yes </label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="diveboat_coxswain_require"  class="rb_divecoxsw_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="diveboat_coxswain_dt" id="diveboat_coxswain_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->diveboat_coxswain_dt) ? date('m/d/Y', strtotime($yacht[0]->diveboat_coxswain_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>
                                                            Diveboat Master
                                                            <input type="hidden" name="diveboat_master" value="Diveboat Master">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="diveboat_master_require"  class="rb_divemster_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="diveboat_master_require"  class="rb_divemster_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="diveboat_master_dt" id="diveboat_master_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->diveboat_master_dt) ? date('m/d/Y', strtotime($yacht[0]->diveboat_master_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>
                                                            First Aid
                                                            <input type="hidden" name="first_aid" value="First Aid">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="first_aid_require"  class="rb_firstaid_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="first_aid_require"  class="rb_firstaid_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="first_aid_dt" id="first_aid_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($yacht[0]->first_aid_dt) ? date('m/d/Y', strtotime($yacht[0]->first_aid_dt)) : '' }}">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>
                                                            International Certificate of Competence for Operators of Pleasure Craft<input type="hidden" name="international_pleasure_craft_certificate" value="International Certificate of Competence for Operators of Pleasure Craft">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="international_pleasure_craft_certificate_require"  class="rb_intercopc_yes" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="international_pleasure_craft_certificate_require"  class="rb_intercopc_no" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="international_pleasure_craft_certificate_dt" id="international_pleasure_craft_certificate_dt" class="form-control" placeholder="Enter Expiry Date" value="{{
                                                                isset($yacht[0]->international_pleasure_craft_certificate_dt) ? date('m/d/Y', strtotime($yacht[0]->international_pleasure_craft_certificate_dt)) : ''
                                                            }}">
                                                        </td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>

                                <!--10 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTen">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                                
                                                others
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                                        <div class="panel-body">
                                            <form name="other_docs_form" method='POST' action="{{ route('anyotherdoc.save') }}">
                                                @csrf
                                                 <input type="hidden" name="candidate_id" value="{{ $candidate_id }}">
                                                 <!-- <input type="hidden" name="document_type" value="Endorsements"> -->
                                                <table id="other_docs_table" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Doc No</th>
                                                        <th>Doc Name</th>
                                                        <th>Do you have it?</th>
                                                        <th>Expiry Date</th>                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>                                                        
                                                            <input type="text" class="form-control" name="doc_name" value="" placeholder="Enter Your Document Name">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="any_other_doc_require" class="radio_otherdoc" value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="any_other_doc_require" class="radio_otherdoc" value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="doc_expiry_dt" id="doc_expiry_dt" class="form-control" placeholder="Enter Expiry Date" value="">                                      
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-success btn-primary small-btn">Save Docs</button>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Accordion end  -->
                        </div>
                    </div>    
                </div>
            </div>
        
        </div>
    </div>
</section>
			<!-- General Detail End -->
@endsection
@section('datepicker')
<script>
    
    $(document).ready(function () {
        setTimeout(function(){
            $(".msg_diplay").remove();
        }, 5000 );

        $('#endorse_table').DataTable();
        $('#traveldoc_table').DataTable();
        $('#medicaldoc_table').DataTable();
        $('#skill_trainingdoc_table').DataTable();
        $('#personaldoc_table').DataTable();
        $('#coc_doc_table').DataTable();
        $('#stcw_doc_table').DataTable();
        $('#offshore_doc_table').DataTable();
        $('#yacht_doc_table').DataTable();

        $('#other_docs_table').DataTable();

        //Endorsement 
        $( "#endors_dec_chemical_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        $('#endors_dec_gas_dt').datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $('#endors_dec_others_dt').datepicker({
           defaultDate: null,
           changeYear: true,
           changeMonth: true,
            yearRange: '1950:2100',
        });
        $('#endors_dec_petroleum_dt').datepicker({
           defaultDate: null,
           changeYear: true,
           changeMonth: true,
            yearRange: '1950:2100',
        });
        $('#endors_others_dt').datepicker({
           defaultDate: null,
           changeYear: true,
           changeMonth: true,
            yearRange: '1950:2100',
        });

        //Travel Docs

        $( "#passport_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        $( "#Seamans_book_cdc_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        $( "#uk_work_permit_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#us_visa_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#others_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        //medical docs
        $( "#drug_alcohol_blood_test_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#seafarers_medical_examination_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#ukooa_medical_fitness_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#yellow_fever_vaccination_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        // $( "#medical_others_dt" ).datepicker({
        //     defaultDate: null,
        //     changeYear: true,
        //     changeMonth: true,
        //     yearRange: '1950:2100',
        // });

        //skill docs        
        $( "#arpa_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#behaviour_safety_process_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#boatmaster_license_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#bridge_team_management_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#chemical_tankertraining_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#cows_crudeoil_washing_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        

        $( "#crane_operator_certificate_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#dp_induction_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#dp_limited_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#dp_simulator_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        //personal docs 
        $( "#driver_license_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#photograph_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#resume_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#personal_other_docs_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        //coc docs
        $( "#officers_incharge_navigational_unlimited_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#master_unlimited_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#chief_mate_unlimited_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#masters_ships_lessthan_500gt_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#officers_charge_navigational_less_500_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#rating_forming_part_navigational_watch_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#able_seafarer_deck_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#officer_charge_engineering_watch_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#chief_engineer_officer_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#second_engineer_officer_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        //stcw docs
        $( "#basic_training_chemical_tc_operations_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#advanced_tc_operations_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#advanced_chemical_tc_operations_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#bt_liquified_gas_tc_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#at_for_liquified_gas_tc_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#crowd_mgt_training_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#safety_training_for_personnel_providing_ds_dt" ).datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#human_behaviour_training_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#crisis_mgt_human_behaviour_training_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#passenger_cargo_hull_integrity_training_dt ").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#basic_safety_tc_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        //offshore Docs
        $( "#agt0_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#agtl1_cbt_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#agt2_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#agt2_cbt_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#agt3_cbt_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        $( "#ama_errv_crew_advanced_medical_aid_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#boat_travel_safely_by_boat_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#boer_basic_onshore_emergency_response_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#bosiet_with_ca_ebs_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#bosiet_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
       
        //YACHT CERTIFICATION
        $( "#advanced_powerboat_certificate_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        $( "#basic_sea_survival_certificate_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#csy_offshore_certificate_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#ds_certificate_competence_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#ds_shorebased_certificate_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#diveboat_coxswain_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#diesel_engine_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        $( "#diveboat_master_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        $( "#first_aid_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        
        $( "#international_pleasure_craft_certificate_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });

        //any other docs
        $( "#doc_expiry_dt").datepicker({
            defaultDate: null,
            changeYear: true,
            changeMonth: true,
            yearRange: '1950:2100',
        });
        
        //hide expiry date text box
        //endorse
        // alert($('#endors_others_dt').val().length);
        //endores show inputbox based on value
        if($('#endors_dec_chemical_dt').val().length != 0){
            $(".rb_end_chemical_yes").attr('checked','checked');
        }else{
            $(".rb_end_chemical_no").attr('checked','checked');
            $("#endors_dec_chemical_dt").hide();
        }

        if($('#endors_dec_gas_dt').val().length != 0){
            $(".rb_end_dec_yes").attr('checked','checked');
        }else{
            $(".rb_end_dec_no").attr('checked','checked');
            $("#endors_dec_gas_dt").hide();
        }

        if($('#endors_dec_others_dt').val().length != 0){
            $(".rb_end_deco_yes").attr('checked','checked');
        }else{
            $(".rb_end_deco_no").attr('checked','checked');
            $("#endors_dec_others_dt").hide();
        }

        if($('#endors_dec_petroleum_dt').val().length != 0){
            $(".rb_edpt_yes").attr('checked','checked');            
        }else{
            $(".rb_edpt_no").attr('checked','checked');
            $('#endors_dec_petroleum_dt').hide();
        }

        // if($('#endors_others_dt').val().length != 0){
        //     $(".rb_ed_other_yes").attr('checked','checked');
        // }else{
        //     $(".rb_ed_other_no").attr('checked','checked');
        //     $("#endors_others_dt").hide();
        // }    

        $("input[name='endors_dec_chemical_require']").click(function(){
            var radio_val = $("input[name='endors_dec_chemical_require']:checked").val();            
            if(radio_val == 'Yes'){
                $('#endors_dec_chemical_dt').show();
            }
            if(radio_val == 'No'){
                $('#endors_dec_chemical_dt').hide();
                $('#endors_dec_chemical_dt').val('');
            }
        });
        $("input[name='endors_dec_gas_require']").click(function(){
            var radio_val = $("input[name='endors_dec_gas_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#endors_dec_gas_dt').show();
            }
            if(radio_val == 'No'){
                $('#endors_dec_gas_dt').hide();
                $('#endors_dec_gas_dt').val('');
            }
        });
        $("input[name='endors_dec_others_require']").click(function(){
            var radio_val = $("input[name='endors_dec_others_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#endors_dec_others_dt').show();
            }
            if(radio_val == 'No'){
                $('#endors_dec_others_dt').hide();
                $('#endors_dec_others_dt').val('');
            }
        });
        $("input[name='endors_dec_petroleum_require']").click(function(){
            var radio_val = $("input[name='endors_dec_petroleum_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#endors_dec_petroleum_dt').show();
            }
            if(radio_val == 'No'){
                $('#endors_dec_petroleum_dt').hide();
                $('#endors_dec_petroleum_dt').val('');
            }
        });

        // $("input[name='endors_others_require']").click(function(){
        //     var radio_val = $("input[name='endors_others_require']:checked").val();
        //     if(radio_val == 'Yes'){
        //         $('#endors_others_dt').show();
        //     }
        //     if(radio_val == 'No'){
        //         $('#endors_others_dt').hide();
        //         $('#endors_others_dt').val('');
        //     } 
        // });

        //Travel show inputbox based on value
        if($('#passport_dt').val().length != 0){
            $(".rb_passport_yes").attr('checked','checked');
        }else{
            $(".rb_passport_no").attr('checked','checked');
            $("#passport_dt").hide();
        }
        $("input[name='passport_dt_require']").click(function(){
            var radio_val = $("input[name='passport_dt_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#passport_dt').show();
            }
            if(radio_val == 'No'){
                $('#passport_dt').hide();
                $('#passport_dt').val('');
            }
        });

        if($('#Seamans_book_cdc_dt').val().length != 0){
            $(".rb_semanbook_yes").attr('checked','checked');
        }else{
            $(".rb_semanbook_no").attr('checked','checked');
            $("#Seamans_book_cdc_dt").hide();
        }
        $("input[name='Seamans_book_cdc_require']").click(function(){
            var radio_val = $("input[name='Seamans_book_cdc_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#Seamans_book_cdc_dt').show();
            }
            if(radio_val == 'No'){
                $('#Seamans_book_cdc_dt').hide();
                $('#Seamans_book_cdc_dt').val('');
            } 
        });
        
        if($('#uk_work_permit_dt').val().length != 0){
            $(".rb_ukpermit_yes").attr('checked','checked');
        }else{
            $(".rb_ukpermit_no").attr('checked','checked');
            $("#uk_work_permit_dt").hide();
        }
        $("input[name='uk_work_permit_require']").click(function(){
            var radio_val = $("input[name='uk_work_permit_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#uk_work_permit_dt').show();
            }
            if(radio_val == 'No'){
                $('#uk_work_permit_dt').hide();
                $('#uk_work_permit_dt').val('');
            } 
        });

        if($('#us_visa_dt').val().length != 0){
            $(".rb_usvisa_yes").attr('checked','checked');
        }else{
            $(".rb_usvisa_no").attr('checked','checked');
            $("#us_visa_dt").hide();
        }
        $("input[name='us_visa_require']").click(function(){
            var radio_val = $("input[name='us_visa_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#us_visa_dt').show();
            }
            if(radio_val == 'No'){
                $('#us_visa_dt').hide();
                $('#us_visa_dt').val('');
            } 
        });

        // if($('#others_dt').val().length != 0){
        //     $(".rb_tra_other_yes").attr('checked','checked');
        // }else{
        //     $(".rb_tra_other_no").attr('checked','checked');
        //     $("#others_dt").hide();
        // }
        // $("input[name='others_dt']").click(function(){
        //     var radio_val = $("input[name='others_dt']:checked").val();
        //     if(radio_val == 'Yes'){
        //         $('#others_dt').show();
        //     }
        //     if(radio_val == 'No'){
        //         $('#others_dt').hide();
        //         $('#others_dt').val('');
        //     } 
        // });
        //medical inputbox show hide
        if($('#drug_alcohol_blood_test_dt').val().length != 0){//1
            $(".rb_drugtest_yes").attr('checked','checked');
        }else{
            $(".rb_drugtest_no").attr('checked','checked');
            $("#drug_alcohol_blood_test_dt").hide();
        }
        $("input[name='drug_alcoloh_test_require']").click(function(){
            var radio_val = $("input[name='drug_alcoloh_test_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#drug_alcohol_blood_test_dt').show();
            }
            if(radio_val == 'No'){
                $('#drug_alcohol_blood_test_dt').hide();
                $('#drug_alcohol_blood_test_dt').val('');
            } 
        });

        if($('#seafarers_medical_examination_dt').val().length != 0){//2
            $(".rb_seadrer_yes").attr('checked','checked');
        }else{
            $(".rb_seadrer_no").attr('checked','checked');
            $("#seafarers_medical_examination_dt").hide();
        }
        $("input[name='Seafarer_mediexa_require_require']").click(function(){
            var radio_val = $("input[name='Seafarer_mediexa_require_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#seafarers_medical_examination_dt').show();
            }
            if(radio_val == 'No'){
                $('#seafarers_medical_examination_dt').hide();
                $('#seafarers_medical_examination_dt').val('');
            } 
        });
        
        if($('#ukooa_medical_fitness_dt').val().length != 0){//3
            
            $(".rb_ukooa_yes").attr('checked','checked');
        }else{
            $(".rb_ukooa_no").attr('checked','checked');
            $("#ukooa_medical_fitness_dt").hide();
        }
        $("input[name='ukooa_medical_fitness_require']").click(function(){
            var radio_val = $("input[name='ukooa_medical_fitness_require']:checked").val();
            // alert(radio_val)
            if(radio_val == 'Yes'){
                $('#ukooa_medical_fitness_dt').show();
            }
            if(radio_val == 'No'){
                $('#ukooa_medical_fitness_dt').hide();
                $('#ukooa_medical_fitness_dt').val('');
            } 
        });

        if($('#yellow_fever_vaccination_dt').val().length != 0){//4
            $(".rb_yfever_yes").attr('checked','checked');
        }else{
            $(".rb_yfever_no").attr('checked','checked');
            $("#yellow_fever_vaccination_dt").hide();
        }
        $("input[name='yellow_fever_vaccination_require']").click(function(){
            var radio_val = $("input[name='yellow_fever_vaccination_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#yellow_fever_vaccination_dt').show();
            }
            if(radio_val == 'No'){
                $('#yellow_fever_vaccination_dt').hide();
                $('#yellow_fever_vaccination_dt').val('');
            } 
        });

        // if($('#medical_others_dt').val().length != 0){//5
        //     $(".rb_ukooa_yes").attr('checked','checked');
        // }else{
        //     $(".rb_ukooa_no").attr('checked','checked');
        //     $("#medical_others_dt").hide();
        // }
        // $("input[name='others_dt']").click(function(){
        //     var radio_val = $("input[name='others_dt']:checked").val();
        //     if(radio_val == 'Yes'){
        //         $('#medical_others_dt').show();
        //     }
        //     if(radio_val == 'No'){
        //         $('#medical_others_dt').hide();
        //         $('#medical_others_dt').val('');
        //     } 
        // });

        // skill and traing hide show docs
        if($('#arpa_dt').val().length != 0){//1

            $(".rb_arpa_yes").attr('checked','checked');
        }else{
            $(".rb_arpa_no").attr('checked','checked');
            $("#arpa_dt").hide();
        }
        $("input[name='arpa_require']").click(function(){
            var radio_val = $("input[name='arpa_require']:checked").val();

            if(radio_val == 'Yes'){
                $('#arpa_dt').show();
            }
            if(radio_val == 'No'){
                $('#arpa_dt').hide();
                $('#arpa_dt').val('');
            } 
        });

        if($('#behaviour_safety_process_dt').val().length != 0){//2
            $(".rb_behaviour_safety_yes").attr('checked','checked');
        }else{
            $(".rb_behaviour_safety_no").attr('checked','checked');
            $("#behaviour_safety_process_dt").hide();
        }
        $("input[name='behaviour_safety_process_require']").click(function(){
            var radio_val = $("input[name='behaviour_safety_process_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#behaviour_safety_process_dt').show();
            }
            if(radio_val == 'No'){
                $('#behaviour_safety_process_dt').hide();
                $('#behaviour_safety_process_dt').val('');
            } 
        });

        if($('#boatmaster_license_dt').val().length != 0){//3
            $(".rb_boat_license_yes").attr('checked','checked');
        }else{
            $(".rb_boat_license_no").attr('checked','checked');
            $("#boatmaster_license_dt").hide();
        }
        $("input[name='boatmaster_license_require']").click(function(){
            var radio_val = $("input[name='boatmaster_license_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#boatmaster_license_dt').show();
            }
            if(radio_val == 'No'){
                $('#boatmaster_license_dt').hide();
                $('#boatmaster_license_dt').val('');
            } 
        });

        if($('#bridge_team_management_dt').val().length != 0){//4
            $(".rb_bridgeteam_mgt_yes").attr('checked','checked');
        }else{
            $(".rb_bridgeteam_mgt_no").attr('checked','checked');
            $("#bridge_team_management_dt").hide();
        }
        $("input[name='bridge_team_management_require']").click(function(){
            var radio_val = $("input[name='bridge_team_management_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#bridge_team_management_dt').show();
            }
            if(radio_val == 'No'){
                $('#bridge_team_management_dt').hide();
                $('#bridge_team_management_dt').val('');
            } 
        });

        if($('#chemical_tankertraining_dt').val().length != 0){//5
            $(".rb_chemical_tank_yes").attr('checked','checked');
        }else{
            $(".rb_chemical_tank_no").attr('checked','checked');
            $("#chemical_tankertraining_dt").hide();
        }
        $("input[name='chemical_tankertraining_require']").click(function(){
            var radio_val = $("input[name='chemical_tankertraining_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#chemical_tankertraining_dt').show();
            }
            if(radio_val == 'No'){
                $('#chemical_tankertraining_dt').hide();
                $('#chemical_tankertraining_dt').val('');
            } 
        });

        if($('#cows_crudeoil_washing_dt').val().length != 0){//6
            $(".rb_cows_yes").attr('checked','checked');
        }else{
            $(".rb_cows_no").attr('checked','checked');
            $("#cows_crudeoil_washing_dt").hide();
        }
        $("input[name='cows_crudeoil_washing_require']").click(function(){
            var radio_val = $("input[name='cows_crudeoil_washing_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#others_dt').show();
            }
            if(radio_val == 'No'){
                $('#cows_crudeoil_washing_dt').hide();
                $('#cows_crudeoil_washing_dt').val('');
            } 
        });

        if($('#crane_operator_certificate_dt').val().length != 0){//7
            $(".rb_crencerti_yes").attr('checked','checked');
        }else{
            $(".rb_crencerti_no").attr('checked','checked');
            $("#crane_operator_certificate_dt").hide();
        }
        $("input[name=crane_operator_certificate_require").click(function(){
            var radio_val = $("input[name='crane_operator_certificate_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#crane_operator_certificate_dt').show();
            }
            if(radio_val == 'No'){
                $('#crane_operator_certificate_dt').hide();
                $('#crane_operator_certificate_dt').val('');
            } 
        });

        if($('#dp_induction_dt').val().length != 0){//8
            $(".rb_dpinduction_yes").attr('checked','checked');
        }else{
            $(".rb_dpinduction_no").attr('checked','checked');
            $("#dp_induction_dt").hide();
        }
        $("input[name=dp_induction_require").click(function(){
            var radio_val = $("input[name='dp_induction_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#dp_induction_dt').show();
            }
            if(radio_val == 'No'){
                $('#dp_induction_dt').hide();
                $('#dp_induction_dt').val('');
            } 
        });

        if($('#dp_limited_dt').val().length != 0){//9
            $(".rb_dplimited_yes").attr('checked','checked');
        }else{
            $(".rb_dplimited_no").attr('checked','checked');
            $("#dp_limited_dt").hide();
        }
        $("input[name=dp_limited_require").click(function(){
            var radio_val = $("input[name='dp_limited_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#dp_limited_dt').show();
            }
            if(radio_val == 'No'){
                $('#dp_limited_dt').hide();
                $('#dp_limited_dt').val('');
            } 
        });

        if($('#dp_simulator_dt').val().length != 0){//10
            $(".rb_dpsimulator_yes").attr('checked','checked');
        }else{
            $(".rb_dpsimulator_no").attr('checked','checked');
            $("#dp_simulator_dt").hide();
        }
        $("input[name=dp_simulator_require").click(function(){
            var radio_val = $("input[name='dp_simulator_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#dp_simulator_dt').show();
            }
            if(radio_val == 'No'){
                $('#dp_simulator_dt').hide();
                $('#dp_simulator_dt').val('');
            } 
        });
        //personal hide show text box
        if($('#driver_license_dt').val().length != 0){//10
            $(".rb_driver_lice_yes").attr('checked','checked');
        }else{
            $(".rb_driver_lice_no").attr('checked','checked');
            $("#driver_license_dt").hide();
        }
        $("input[name=driver_license_require").click(function(){
            var radio_val = $("input[name='driver_license_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#driver_license_dt').show();
            }
            if(radio_val == 'No'){
                $('#driver_license_dt').hide();
                $('#driver_license_dt').val('');
            } 
        });

        if($('#photograph_dt').val().length != 0){//2
            $(".rb_photograph_yes").attr('checked','checked');
        }else{
            $(".rb_photograph_no").attr('checked','checked');
            $("#photograph_dt").hide();
        }
        $("input[name=photograph_require").click(function(){
            var radio_val = $("input[name='photograph_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#photograph_dt').show();
            }
            if(radio_val == 'No'){
                $('#photograph_dt').hide();
                $('#photograph_dt').val('');
            } 
        });

        if($('#resume_dt').val().length != 0){//3
            $(".rb_resume_yes").attr('checked','checked');
        }else{
            $(".rb_resume_no").attr('checked','checked');
            $("#resume_dt").hide();
        }
        $("input[name=resume_require").click(function(){
            var radio_val = $("input[name='resume_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#resume_dt').show();
            }
            if(radio_val == 'No'){
                $('#resume_dt').hide();
                $('#resume_dt').val('');
            } 
        });

        if($('#personal_other_docs_dt').val().length != 0){//4
            $(".rb_per_otherdocs_yes").attr('checked','checked');
        }else{
            $(".rb_per_otherdocs_no").attr('checked','checked');
            $("#personal_other_docs_dt").hide();
        }
        $("input[name=personal_other_docs_require").click(function(){
            var radio_val = $("input[name='personal_other_docs_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#personal_other_docs_dt').show();
            }
            if(radio_val == 'No'){
                $('#personal_other_docs_dt').hide();
                $('#personal_other_docs_dt').val('');
            } 
        });
        //coc
        if($('#officers_incharge_navigational_unlimited_dt').val().length != 0){//1
            $(".rb_officer_nav_watch_yes").attr('checked','checked');
        }else{
            $(".rb_officer_nav_watch_no").attr('checked','checked');
            $("#officers_incharge_navigational_unlimited_dt").hide();
        }
        $("input[name=officers_incharge_navigational_unlimited_require").click(function(){
            var radio_val = $("input[name='officers_incharge_navigational_unlimited_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#officers_incharge_navigational_unlimited_dt').show();
            }
            if(radio_val == 'No'){
                $('#officers_incharge_navigational_unlimited_dt').hide();
                $('#officers_incharge_navigational_unlimited_dt').val('');
            } 
        });

        if($('#master_unlimited_dt').val().length != 0){//2
            $(".rb_masunlimit_yes").attr('checked','checked');
        }else{
            $(".rb_masunlimit_no").attr('checked','checked');
            $("#master_unlimited_dt").hide();
        }
        $("input[name=master_unlimited_require").click(function(){
            var radio_val = $("input[name='master_unlimited_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#master_unlimited_dt').show();
            }
            if(radio_val == 'No'){
                $('#master_unlimited_dt').hide();
                $('#master_unlimited_dt').val('');
            } 
        });

        if($('#chief_mate_unlimited_dt').val().length != 0){//3
            $(".rb_cmateunli_yes").attr('checked','checked');
        }else{
            $(".rb_cmateunli_no").attr('checked','checked');
            $("#chief_mate_unlimited_dt").hide();
        }
        $("input[name=chief_mate_unlimited_require").click(function(){
            var radio_val = $("input[name='chief_mate_unlimited_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#chief_mate_unlimited_dt').show();
            }
            if(radio_val == 'No'){
                $('#chief_mate_unlimited_dt').hide();
                $('#chief_mate_unlimited_dt').val('');
            } 
        });

        if($('#masters_ships_lessthan_500gt_dt').val().length != 0){//4
            $(".rb_mshiogre500_yes").attr('checked','checked');
        }else{
            $(".rb_mshiogre500_no").attr('checked','checked');
            $("#masters_ships_lessthan_500gt_dt").hide();
        }

        $("input[name=masters_ships_lessthan_500gt_require").click(function(){
            var radio_val = $("input[name='masters_ships_lessthan_500gt_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#masters_ships_lessthan_500gt_dt').show();
            }
            if(radio_val == 'No'){
                $('#masters_ships_lessthan_500gt_dt').hide();
                $('#masters_ships_lessthan_500gt_dt').val('');
            } 
        });

        if($('#officers_charge_navigational_less_500_dt').val().length != 0){//5
            $(".rb_navofficer500_yes").attr('checked','checked');
        }else{
            $(".rb_navofficer500_no").attr('checked','checked');
            $("#officers_charge_navigational_less_500_dt").hide();
        }
        
        $("input[name=officers_charge_navigational_less_500_require").click(function(){
            var radio_val = $("input[name='officers_charge_navigational_less_500_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#officers_charge_navigational_less_500_dt').show();
            }
            if(radio_val == 'No'){
                $('#officers_charge_navigational_less_500_dt').hide();
                $('#officers_charge_navigational_less_500_dt').val('');
            } 
        });

        if($('#rating_forming_part_navigational_watch_dt').val().length != 0){//6
            $(".rb_ratingnavwatch_yes").attr('checked','checked');
        }else{
            $(".rb_ratingnavwatch_no").attr('checked','checked');
            $("#rating_forming_part_navigational_watch_dt").hide();
        }
        
        $("input[name=rating_forming_part_navigational_watch_require").click(function(){
            var radio_val = $("input[name='rating_forming_part_navigational_watch_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#rating_forming_part_navigational_watch_dt').show();
            }
            if(radio_val == 'No'){
                $('#rating_forming_part_navigational_watch_dt').hide();
                $('#rating_forming_part_navigational_watch_dt').val('');
            } 
        });

        if($('#able_seafarer_deck_dt').val().length != 0){//7
            $(".rb_ablsererd_yes").attr('checked','checked');
        }else{
            $(".rb_ablsererd_no").attr('checked','checked');
            $("#able_seafarer_deck_dt").hide();
        }
        
        $("input[name=able_seafarer_deck_require").click(function(){
            var radio_val = $("input[name='able_seafarer_deck_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#able_seafarer_deck_dt').show();
            }
            if(radio_val == 'No'){
                $('#able_seafarer_deck_dt').hide();
                $('#able_seafarer_deck_dt').val('');
            } 
        });
        
        if($('#officer_charge_engineering_watch_dt').val().length != 0){//8
            $(".rb_offwatchin_yes").attr('checked','checked');
        }else{
            $(".rb_offwatchin_no").attr('checked','checked');
            $("#officer_charge_engineering_watch_dt").hide();
        }
        
        $("input[name=officer_charge_engineering_watch_require").click(function(){
            var radio_val = $("input[name='officer_charge_engineering_watch_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#officer_charge_engineering_watch_dt').show();
            }
            if(radio_val == 'No'){
                $('#officer_charge_engineering_watch_dt').hide();
                $('#officer_charge_engineering_watch_dt').val('');
            } 
        });

        if($('#chief_engineer_officer_dt').val().length != 0){//9
            $(".rb_chiefEO_yes").attr('checked','checked');
        }else{
            $(".rb_chiefEO_no").attr('checked','checked');
            $("#chief_engineer_officer_dt").hide();
        }
        
        $("input[name=chief_engineer_officer_require").click(function(){
            var radio_val = $("input[name='chief_engineer_officer_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#chief_engineer_officer_dt').show();
            }
            if(radio_val == 'No'){
                $('#chief_engineer_officer_dt').hide();
                $('#chief_engineer_officer_dt').val('');
            } 
        });

        if($('#second_engineer_officer_dt').val().length != 0){//10
            $(".rb_secEO_yes").attr('checked','checked');
        }else{
            $(".rb_secEO_no").attr('checked','checked');
            $("#second_engineer_officer_dt").hide();
        }
        
        $("input[name=second_engineer_officer_require").click(function(){
            var radio_val = $("input[name='second_engineer_officer_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#second_engineer_officer_dt').show();
            }
            if(radio_val == 'No'){
                $('#second_engineer_officer_dt').hide();
                $('#second_engineer_officer_dt').val('');
            } 
        });
        //stcw
        
        if($('#basic_training_chemical_tc_operations_dt').val().length != 0){//1
            $(".rb_btchemitcopr_yes").attr('checked','checked');
        }else{
            $(".rb_btchemitcopr_no").attr('checked','checked');
            $("#basic_training_chemical_tc_operations_dt").hide();
        }
        
        $("input[name=basic_training_chemical_tc_operations_require").click(function(){
            var radio_val = $("input[name='basic_training_chemical_tc_operations_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#basic_training_chemical_tc_operations_dt').show();
            }
            if(radio_val == 'No'){
                $('#basic_training_chemical_tc_operations_dt').hide();
                $('#basic_training_chemical_tc_operations_dt').val('');
            } 
        });

        if($('#advanced_tc_operations_dt').val().length != 0){//2
            $(".rb_atfocaropr_yes").attr('checked','checked');
        }else{
            $(".rb_atfocaropr_no").attr('checked','checked');
            $("#advanced_tc_operations_dt").hide();
        }
        
        $("input[name=advanced_tc_operations_require").click(function(){
            var radio_val = $("input[name='advanced_tc_operations_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#advanced_tc_operations_dt').show();
            }
            if(radio_val == 'No'){
                $('#advanced_tc_operations_dt').hide();
                $('#advanced_tc_operations_dt').val('');
            } 
        });
        
        if($('#advanced_chemical_tc_operations_dt').val().length != 0){//3
            $(".rb_atfortco_yes").attr('checked','checked');
        }else{
            $(".rb_atfortco_no").attr('checked','checked');
            $("#advanced_chemical_tc_operations_dt").hide();
        }
        
        $("input[name=advanced_chemical_tc_operations_require").click(function(){
            var radio_val = $("input[name='advanced_chemical_tc_operations_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#advanced_chemical_tc_operations_dt').show();
            }
            if(radio_val == 'No'){
                $('#advanced_chemical_tc_operations_dt').hide();
                $('#advanced_chemical_tc_operations_dt').val('');
            } 
        });
        
        if($('#bt_liquified_gas_tc_dt').val().length != 0){//3
            $(".rb_liquidgsc_yes").attr('checked','checked');
        }else{
            $(".rb_liquidgsc_no").attr('checked','checked');
            $("#bt_liquified_gas_tc_dt").hide();
        }
        
        $("input[name=bt_liquified_gas_tc_require").click(function(){
            var radio_val = $("input[name='bt_liquified_gas_tc_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#bt_liquified_gas_tc_dt').show();
            }
            if(radio_val == 'No'){
                $('#bt_liquified_gas_tc_dt').hide();
                $('#bt_liquified_gas_tc_dt').val('');
            } 
        });

        if($('#at_for_liquified_gas_tc_dt').val().length != 0){//4
            $(".rb_atflgasc_yes").attr('checked','checked');
        }else{
            $(".rb_atflgasc_no").attr('checked','checked');
            $("#at_for_liquified_gas_tc_dt").hide();
        }
        
        $("input[name=at_for_liquified_gas_tc_require").click(function(){
            var radio_val = $("input[name='at_for_liquified_gas_tc_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#at_for_liquified_gas_tc_dt').show();
            }
            if(radio_val == 'No'){
                $('#at_for_liquified_gas_tc_dt').hide();
                $('#at_for_liquified_gas_tc_dt').val('');
            } 
        });
        
        if($('#crowd_mgt_training_dt').val().length != 0){//6
            $(".rb_cmgttra_yes").attr('checked','checked');
        }else{
            $(".rb_cmgttra_no").attr('checked','checked');
            $("#crowd_mgt_training_dt").hide();
        }
        
        $("input[name=crowd_mgt_training_require").click(function(){
            var radio_val = $("input[name='crowd_mgt_training_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#crowd_mgt_training_dt').show();
            }
            if(radio_val == 'No'){
                $('#crowd_mgt_training_dt').hide();
                $('#crowd_mgt_training_dt').val('');
            } 
        });

        if($('#safety_training_for_personnel_providing_ds_dt').val().length != 0){//7
            $(".rb_safetpdstopp_yes").attr('checked','checked');
        }else{
            $(".rb_safetpdstopp_no").attr('checked','checked');
            $("#safety_training_for_personnel_providing_ds_dt").hide();
        }
        
        $("input[name=safety_training_for_personnel_providing_ds_require").click(function(){
            var radio_val = $("input[name='safety_training_for_personnel_providing_ds_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#safety_training_for_personnel_providing_ds_dt').show();
            }
            if(radio_val == 'No'){
                $('#safety_training_for_personnel_providing_ds_dt').hide();
                $('#safety_training_for_personnel_providing_ds_dt').val('');
            } 
        });

        
        if($('#crisis_mgt_human_behaviour_training_dt').val().length != 0){//8
            $(".rb_cmgtht_yes").attr('checked','checked');
        }else{
            $(".rb_cmgtht_no").attr('checked','checked');
            $("#crisis_mgt_human_behaviour_training_dt").hide();
        }
        
        $("input[name=crisis_mgt_human_behaviour_training_require").click(function(){
            var radio_val = $("input[name='crisis_mgt_human_behaviour_training_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#crisis_mgt_human_behaviour_training_dt').show();
            }
            if(radio_val == 'No'){
                $('#crisis_mgt_human_behaviour_training_dt').hide();
                $('#crisis_mgt_human_behaviour_training_dt').val('');
            } 
        });

        if($('#passenger_cargo_hull_integrity_training_dt').val().length != 0){//9
            $(".rb_hullinte_cs_yes").attr('checked','checked');
        }else{
            $(".rb_hullinte_cs_no").attr('checked','checked');
            $("#passenger_cargo_hull_integrity_training_dt").hide();
        }
        
        $("input[name=passenger_cargo_passenger_cargo_hull_integrity_training_require").click(function(){
            var radio_val = $("input[name='passenger_cargo_passenger_cargo_hull_integrity_training_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#passenger_cargo_hull_integrity_training_dt').show();
            }
            if(radio_val == 'No'){
                $('#passenger_cargo_hull_integrity_training_dt').hide();
                $('#passenger_cargo_hull_integrity_training_dt').val('');
            } 
        });
        
        if($('#basic_safety_tc_dt').val().length != 0){//10
            $(".rb_basicstc_yes").attr('checked','checked');
        }else{
            $(".rb_basicstc_no").attr('checked','checked');
            $("#basic_safety_tc_dt").hide();
        }
        
        $("input[name=basic_safety_tc_require").click(function(){
            var radio_val = $("input[name='basic_safety_tc_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#basic_safety_tc_dt').show();
            }
            if(radio_val == 'No'){
                $('#basic_safety_tc_dt').hide();
                $('#basic_safety_tc_dt').val('');
            } 
        });
        //offshore
        if($('#agt0_dt').val().length != 0){//1
            $(".rb_AGT0_yes").attr('checked','checked');
        }else{
            $(".rb_AGT0_no").attr('checked','checked');
            $("#agt0_dt").hide();
        }
        
        $("input[name=agt0_dt_require").click(function(){
            var radio_val = $("input[name='agt0_dt_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#agt0_dt').show();
            }
            if(radio_val == 'No'){
                $('#agt0_dt').hide();
                $('#agt0_dt').val('');
            } 
        });

        if($('#agtl1_cbt_dt').val().length != 0){//2
            $(".rb_AGT2_yes").attr('checked','checked');
        }else{
            $(".rb_AGT2_no").attr('checked','checked');
            $("#agtl1_cbt_dt").hide();
        }
        
        $("input[name=agtl1_cbt_dt").click(function(){
            var radio_val = $("input[name='agtl1_cbt_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#agtl1_cbt_dt').show();
            }
            if(radio_val == 'No'){
                $('#agtl1_cbt_dt').hide();
                $('#agtl1_cbt_dt').val('');
            } 
        });

        if($('#agt2_dt').val().length != 0){//3
            $(".rb_AGT1agtl2_yes").attr('checked','checked');
        }else{
            $(".rb_AGT1agtl2_no").attr('checked','checked');
            $("#agt2_dt").hide();
        }
        
        $("input[name=agt2_require").click(function(){
            var radio_val = $("input[name='agt2_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#agt2_dt').show();
            }
            if(radio_val == 'No'){
                $('#agt2_dt').hide();
                $('#agt2_dt').val('');
            } 
        });

        if($('#agt2_cbt_dt').val().length != 0){//4
            $(".rb_AGT1cbtagttl2_yes").attr('checked','checked');
        }else{
            $(".rb_AGT1cbtagttl2_no").attr('checked','checked');
            $("#agt2_cbt_dt").hide();
        }
        
        $("input[name=agt2_cbt_require").click(function(){
            var radio_val = $("input[name='agt2_cbt_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#agt2_cbt_dt').show();
            }
            if(radio_val == 'No'){
                $('#agt2_cbt_dt').hide();
                $('#agt2_cbt_dt').val('');
            } 
        });

        if($('#agt3_cbt_dt').val().length != 0){//5
            $(".rb_AGT3agttl3_yes").attr('checked','checked');
        }else{
            $(".rb_AGT3agttl3_no").attr('checked','checked');
            $("#agt3_cbt_dt").hide();
        }
        
        $("input[name=agt3_cbt_require").click(function(){
            var radio_val = $("input[name='agt3_cbt_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#agt3_cbt_dt').show();
            }
            if(radio_val == 'No'){
                $('#agt3_cbt_dt').hide();
                $('#agt3_cbt_dt').val('');
            } 
        });
        if($('#ama_errv_crew_advanced_medical_aid_dt').val().length != 0){//6
            $(".rb_amaerrvmaid_yes").attr('checked','checked');
        }else{
            $(".rb_amaerrvmaid_no").attr('checked','checked');
            $("#ama_errv_crew_advanced_medical_aid_dt").hide();
        }
        
        $("input[name=ama_errv_crew_advanced_medical_aid_require").click(function(){
            var radio_val = $("input[name='ama_errv_crew_advanced_medical_aid_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#ama_errv_crew_advanced_medical_aid_dt').show();
            }
            if(radio_val == 'No'){
                $('#ama_errv_crew_advanced_medical_aid_dt').hide();
                $('#ama_errv_crew_advanced_medical_aid_dt').val('');
            } 
        });

        if($('#boat_travel_safely_by_boat_dt').val().length != 0){//7
            $(".rb_boattsboat_yes").attr('checked','checked');
        }else{
            $(".rb_boattsboat_no").attr('checked','checked');
            $("#boat_travel_safely_by_boat_dt").hide();
        }
        
        $("input[name=boat_travel_safely_by_boat_require").click(function(){
            var radio_val = $("input[name='boat_travel_safely_by_boat_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#boat_travel_safely_by_boat_dt').show();
            }
            if(radio_val == 'No'){
                $('#boat_travel_safely_by_boat_dt').hide();
                $('#boat_travel_safely_by_boat_dt').val('');
            } 
        });

        if($('#boer_basic_onshore_emergency_response_dt').val().length != 0){//8
            $(".rb_boer_yes").attr('checked','checked');
        }else{
            $(".rb_boer_no").attr('checked','checked');
            $("#boer_basic_onshore_emergency_response_dt").hide();
        }
        
        $("input[name=boer_basic_onshore_emergency_response_require").click(function(){
            var radio_val = $("input[name='boer_basic_onshore_emergency_response_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#boer_basic_onshore_emergency_response_dt').show();
            }
            if(radio_val == 'No'){
                $('#boer_basic_onshore_emergency_response_dt').hide();
                $('#boer_basic_onshore_emergency_response_dt').val('');
            } 
        });

        if($('#bosiet_with_ca_ebs_dt').val().length != 0){//9
            $(".rb_bosiet_caebs_yes").attr('checked','checked');
        }else{
            $(".rb_bosiet_caebs_no").attr('checked','checked');
            $("#bosiet_with_ca_ebs_dt").hide();
        }
        
        $("input[name=bosiet_with_ca_ebs_require").click(function(){
            var radio_val = $("input[name='bosiet_with_ca_ebs_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#bosiet_with_ca_ebs_dt').show();
            }
            if(radio_val == 'No'){
                $('#bosiet_with_ca_ebs_dt').hide();
                $('#bosiet_with_ca_ebs_dt').val('');
            } 
        });
        
        
        if($('#bosiet_dt').val().length != 0){//9
            $(".rb_bosietet_yes").attr('checked','checked');
        }else{
            $(".rb_bosietet_no").attr('checked','checked');
            $("#bosiet_dt").hide();
        }
        
        $("input[name=bosiet_require").click(function(){
            var radio_val = $("input[name='bosiet_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#bosiet_dt').show();
            }
            if(radio_val == 'No'){
                $('#bosiet_dt').hide();
                $('#bosiet_dt').val('');
            } 
        });
        //yatch certificate
        if($('#advanced_powerboat_certificate_dt').val().length != 0){//1
            $(".rb_advpowc_yes").attr('checked','checked');
        }else{
            $(".rb_advpowc_no").attr('checked','checked');
            $("#advanced_powerboat_certificate_dt").hide();
        }
        
        $("input[name=advanced_powerboat_certificate_require").click(function(){
            var radio_val = $("input[name='advanced_powerboat_certificate_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#advanced_powerboat_certificate_dt').show();
            }
            if(radio_val == 'No'){
                $('#advanced_powerboat_certificate_dt').hide();
                $('#advanced_powerboat_certificate_dt').val('');
            } 
        });
        
        if($('#basic_sea_survival_certificate_dt').val().length != 0){//2
            $(".rb_seaservival_yes").attr('checked','checked');
        }else{
            $(".rb_seaservival_no").attr('checked','checked');
            $("#basic_sea_survival_certificate_dt").hide();
        }
        
        $("input[name=basic_sea_survival_certificate_require").click(function(){
            var radio_val = $("input[name='basic_sea_survival_certificate_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#basic_sea_survival_certificate_dt').show();
            }
            if(radio_val == 'No'){
                $('#basic_sea_survival_certificate_dt').hide();
                $('#basic_sea_survival_certificate_dt').val('');
            } 
        });

        if($('#csy_offshore_certificate_dt').val().length != 0){//3
            $(".rb_costyoffsc_yes").attr('checked','checked');
        }else{
            $(".rb_costyoffsc_no").attr('checked','checked');
            $("#csy_offshore_certificate_dt").hide();
        }
        
        $("input[name=csy_offshore_certificate_require").click(function(){
            var radio_val = $("input[name='csy_offshore_certificate_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#csy_offshore_certificate_dt').show();
            }
            if(radio_val == 'No'){
                $('#csy_offshore_certificate_dt').hide();
                $('#csy_offshore_certificate_dt').val('');
            } 
        });

        if($('#ds_certificate_competence_dt').val().length != 0){//4
            $(".rb_datskipcom_no").attr('checked','checked');
        }else{
            $(".rb_datskipcom_no").attr('checked','checked');
            $("#ds_certificate_competence_dt").hide();
        }
        
        $("input[name=ds_certificate_competence_require").click(function(){
            var radio_val = $("input[name='ds_certificate_competence_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#ds_certificate_competence_dt').show();
            }
            if(radio_val == 'No'){
                $('#ds_certificate_competence_dt').hide();
                $('#ds_certificate_competence_dt').val('');
            } 
        });

        if($('#ds_shorebased_certificate_dt').val().length != 0){//5
            $(".rb_dskshorebase_no").attr('checked','checked');
        }else{
            $(".rb_dskshorebase_no").attr('checked','checked');
            $("#ds_shorebased_certificate_dt").hide();
        }
        
        $("input[name=ds_shorebased_certificate_require").click(function(){
            var radio_val = $("input[name='ds_shorebased_certificate_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#ds_shorebased_certificate_dt').show();
            }
            if(radio_val == 'No'){
                $('#ds_shorebased_certificate_dt').hide();
                $('#ds_shorebased_certificate_dt').val('');
            } 
        });

        if($('#diesel_engine_dt').val().length != 0){//6
            $(".rb_dieselegine_yes").attr('checked','checked');
        }else{
            $(".rb_dieselegine_no").attr('checked','checked');
            $("#diesel_engine_dt").hide();
        }
        
        $("input[name=diesel_engine_require").click(function(){
            var radio_val = $("input[name='diesel_engine_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#diesel_engine_dt').show();
            }
            if(radio_val == 'No'){
                $('#diesel_engine_dt').hide();
                $('#diesel_engine_dt').val('');
            } 
        });

        if($('#diveboat_coxswain_dt').val().length != 0){//7
            $(".rb_divecoxsw_yes").attr('checked','checked');
        }else{
            $(".rb_divecoxsw_no").attr('checked','checked');
            $("#diveboat_coxswain_dt").hide();
        }
        
        $("input[name=diveboat_coxswain_require").click(function(){
            var radio_val = $("input[name='diveboat_coxswain_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#diveboat_coxswain_dt').show();
            }
            if(radio_val == 'No'){
                $('#diveboat_coxswain_dt').hide();
                $('#diveboat_coxswain_dt').val('');
            } 
        });

        if($('#diveboat_master_dt').val().length != 0){//8
            $(".rb_divemster_yes").attr('checked','checked');
        }else{
            $(".rb_divemster_no").attr('checked','checked');
            $("#diveboat_master_dt").hide();
        }
        
        $("input[name=diveboat_master_require").click(function(){
            var radio_val = $("input[name='diveboat_master_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#diveboat_master_dt').show();
            }
            if(radio_val == 'No'){
                $('#diveboat_master_dt').hide();
                $('#diveboat_master_dt').val('');
            } 
        });

        if($('#first_aid_dt').val().length != 0){//9
            $(".rb_firstaid_yes").attr('checked','checked');
        }else{
            $(".rb_firstaid_no").attr('checked','checked');
            $("#first_aid_dt").hide();
        }
        
        $("input[name=first_aid_require").click(function(){
            var radio_val = $("input[name='first_aid_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#first_aid_dt').show();
            }
            if(radio_val == 'No'){
                $('#first_aid_dt').hide();
                $('#first_aid_dt').val('');
            } 
        });

        if($('#international_pleasure_craft_certificate_dt').val().length != 0){//10
            $(".rb_intercopc_yes").attr('checked','checked');
        }else{
            $(".rb_intercopc_no").attr('checked','checked');
            $("#international_pleasure_craft_certificate_dt").hide();
        }
        
        $("input[name=international_pleasure_craft_certificate_require").click(function(){
            var radio_val = $("input[name='international_pleasure_craft_certificate_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#international_pleasure_craft_certificate_dt').show();
            }
            if(radio_val == 'No'){
                $('#international_pleasure_craft_certificate_dt').hide();
                $('#international_pleasure_craft_certificate_dt').val('');
            } 
        });

        //any other docs
        $('#doc_expiry_dt').hide();
        $('.radio_otherdoc').click(function(){
            var radio_val = $("input[name='any_other_doc_require']:checked").val();
            if(radio_val == 'Yes'){
                $('#doc_expiry_dt').show();
            }
            if(radio_val == 'No'){
                $('#doc_expiry_dt').hide();
            }
        });

        //active return tab
        var return_tab = '<?php echo $return_tab ?>';
        // alert('return_tab '+ return_tab)
        if(return_tab == '' || return_tab == 'endorse_tab'){
            $('#collapseOne').addClass(" in");            
            $('#headingOne .panel-title > a').removeClass("old_tab");
            $('#collapseTwo').removeClass(" in");
            $('#headingTwo .panel-title > a').addClass("collapsed");
            $('#collapseThree').removeClass(" in");
            $('#headingThree .panel-title > a').addClass("old_tab");
            $('#collapseFour').removeClass(" in");
            $('#headingFour .panel-title > a').addClass("old_tab");
            $('#collapseFive').removeClass(" in");
            $('#headingFive .panel-title > a').addClass("old_tab");
            $('#collapseSix').removeClass(" in");
            $('#headingSix .panel-title > a').addClass("old_tab");
            $('#collapseSeven').removeClass(" in");
            $('#headingSeven .panel-title > a').addClass("old_tab");
            $('#collapseEight').removeClass(" in");
            $('#headingEight .panel-title > a').addClass("old_tab");
            $('#collapseNine').removeClass(" in");
            $('#headingNine .panel-title > a').addClass("old_tab");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        if(return_tab == 'travel_tab'){
            $('#collapseOne').removeClass(" in");            
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseTwo').addClass(" in");
            $('#headingTwo .panel-title > a').removeClass("collapsed");
            $('#collapseThree').removeClass(" in");
            $('#headingThree .panel-title > a').addClass("old_tab");
            $('#collapseFour').removeClass(" in");
            $('#headingFour .panel-title > a').addClass("old_tab");
            $('#collapseFive').removeClass(" in");
            $('#headingFive .panel-title > a').addClass("old_tab");
            $('#collapseSix').removeClass(" in");
            $('#headingSix .panel-title > a').addClass("old_tab");
            $('#collapseSeven').removeClass(" in");
            $('#headingSeven .panel-title > a').addClass("old_tab");
            $('#collapseEight').removeClass(" in");
            $('#headingEight .panel-title > a').addClass("old_tab");
            $('#collapseNine').removeClass(" in");
            $('#headingNine .panel-title > a').addClass("old_tab");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        if(return_tab == 'medical_tab'){//3
            $('#collapseOne').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseTwo').removeClass(" in");
            $('#collapseThree').addClass(" in");
            $('#headingThree .panel-title > a').removeClass("collapsed");
            $('#collapseFour').removeClass(" in");
            $('#headingFour .panel-title > a').addClass("old_tab");
            $('#collapseFive').removeClass(" in");
            $('#headingFive .panel-title > a').addClass("old_tab");
            $('#collapseSix').removeClass(" in");
            $('#headingSix .panel-title > a').addClass("old_tab");
            $('#collapseSeven').removeClass(" in");
            $('#headingSeven .panel-title > a').addClass("old_tab");
            $('#collapseEight').removeClass(" in");
            $('#headingEight .panel-title > a').addClass("old_tab");
            $('#collapseNine').removeClass(" in");
            $('#headingNine .panel-title > a').addClass("old_tab");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        if(return_tab == 'skill_tab'){//4
            $('#collapseOne').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseTwo').removeClass(" in");
            $('#headingTwo .panel-title > a').addClass("old_tab");
            $('#collapseThree').removeClass(" in"); 
            $('#headingThree .panel-title > a').addClass("old_tab");           
            $('#collapseFour').addClass(" in");
            $('#headingFour .panel-title > a').removeClass("collapsed");
            $('#collapseFive').removeClass(" in");
            $('#headingFive .panel-title > a').addClass("old_tab");
            $('#collapseSix').removeClass(" in");
            $('#headingSix .panel-title > a').addClass("old_tab");
            $('#collapseSeven').removeClass(" in");
            $('#headingSeven .panel-title > a').addClass("old_tab");
            $('#collapseEight').removeClass(" in");
            $('#headingEight .panel-title > a').addClass("old_tab");
            $('#collapseNine').removeClass(" in");
            $('#headingNine .panel-title > a').addClass("old_tab");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        if(return_tab == 'personal_tab'){//5
            $('#collapseOne').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseTwo').removeClass(" in");
            $('#headingTwo .panel-title > a').addClass("old_tab");
            $('#collapseThree').removeClass(" in"); 
            $('#headingThree .panel-title > a').addClass("old_tab");           
            $('#collapseFour').removeClass(" in");
            $('#headingFour .panel-title > a').addClass("old_tab");
            $('#collapseFive').addClass(" in");
            $('#headingFive .panel-title > a').removeClass("collapsed");
            $('#collapseSix').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseSeven').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseEight').removeClass(" in");
            $('#headingEight .panel-title > a').addClass("old_tab");
            $('#collapseNine').removeClass(" in");
            $('#headingNine .panel-title > a').addClass("old_tab");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        if(return_tab == 'coc_tab'){//6
            $('#collapseOne').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseTwo').removeClass(" in");
            $('#headingTwo .panel-title > a').addClass("old_tab");
            $('#collapseThree').removeClass(" in");
            $('#headingThree .panel-title > a').addClass("old_tab");            
            $('#collapseFour').removeClass(" in");
            $('#headingFour .panel-title > a').addClass("old_tab");
            $('#collapseFive').removeClass(" in");
            $('#headingFive .panel-title > a').addClass("old_tab");
            $('#collapseSix').addClass(" in");
            $('#headingSix .panel-title > a').removeClass("collapsed");
            $('#collapseSeven').removeClass(" in");
            $('#headingSeven .panel-title > a').addClass("old_tab");
            $('#collapseEight').removeClass(" in");
            $('#headingEight .panel-title > a').addClass("old_tab");
            $('#collapseNine').removeClass(" in");
            $('#headingNine .panel-title > a').addClass("old_tab");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        if(return_tab == 'stcw_tab'){//7
            $('#collapseOne').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseTwo').removeClass(" in");
            $('#headingTwo .panel-title > a').addClass("old_tab");
            $('#collapseThree').removeClass(" in"); 
            $('#headingThree .panel-title > a').addClass("old_tab");           
            $('#collapseFour').removeClass(" in");
            $('#headingFour .panel-title > a').addClass("old_tab");
            $('#collapseFive').removeClass(" in");
            $('#headingFive .panel-title > a').addClass("old_tab");
            $('#collapseSix').removeClass(" in");
            $('#headingSix .panel-title > a').addClass("old_tab");
            $('#collapseSeven').addClass(" in");
            $('#headingSeven .panel-title > a').removeClass("collapsed");
            $('#collapseEight').removeClass(" in");
            $('#headingEight .panel-title > a').addClass("old_tab");
            $('#collapseNine').removeClass(" in");
            $('#headingNine .panel-title > a').addClass("old_tab");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        if(return_tab == 'offshore_tab'){//8
            $('#collapseOne').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseTwo').removeClass(" in");
            $('#headingTwo .panel-title > a').addClass("old_tab");
            $('#collapseThree').removeClass(" in"); 
            $('#headingaThree .panel-title > a').addClass("old_tab");           
            $('#collapseFour').removeClass(" in");
            $('#headingFour .panel-title > a').addClass("old_tab");
            $('#collapseFive').removeClass(" in");
            $('#headingFive .panel-title > a').addClass("old_tab");
            $('#collapseSix').removeClass(" in");
            $('#headingSix .panel-title > a').addClass("old_tab");
            $('#collapseSeven').removeClass(" in");
            $('#headingSeven .panel-title > a').addClass("old_tab");
            $('#collapseEight').addClass(" in");
            $('#headingEight .panel-title > a').removeClass("collapsed");
            $('#collapseNine').removeClass(" in");
            $('#headingNine .panel-title > a').addClass("old_tab");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        
        if(return_tab == 'yacht_tab'){//9
            $('#collapseOne').removeClass(" in");
            $('#headingOne .panel-title > a').addClass("old_tab");
            $('#collapseTwo').removeClass(" in");
            $('#headingTwo .panel-title > a').addClass("old_tab");
            $('#collapseThree').removeClass(" in");
            $('#headingaThree .panel-title > a').addClass("old_tab");            
            $('#collapseFour').removeClass(" in");
            $('#headingFour .panel-title > a').addClass("old_tab");
            $('#collapseFive').removeClass(" in");
            $('#headingFive .panel-title > a').addClass("old_tab");
            $('#collapseSix').removeClass(" in");
            $('#headingSix .panel-title > a').addClass("old_tab");
            $('#collapseSeven').removeClass(" in");
            $('#headingSeven .panel-title > a').addClass("old_tab");
            $('#collapseEight').removeClass(" in");
            $('#headingSeven .panel-title > a').addClass("old_tab");
            $('#collapseNine').addClass(" in");
            $('#headingNine .panel-title > a').removeClass("collapsed");
            $('#collapseTen').removeClass(" in");
            $('#headingTen .panel-title > a').addClass("old_tab");
        }
        if(return_tab == 'any_other_tab'){
            $('#collapseOne').removeClass(" in");
            $('#collapseTwo').removeClass(" in");
            $('#collapseThree').removeClass(" in");            
            $('#collapseFour').removeClass(" in");
            $('#collapseFive').removeClass(" in");
            $('#collapseSix').removeClass(" in");
            $('#collapseSeven').removeClass(" in");
            $('#collapseEight').removeClass(" in");
            $('#collapseNine').removeClass(" in");
            $('#collapseTen').addClass(" in");
            $('#headingNine .panel-title > a').removeClass("collapsed");
        }
        
        
    });//Document ready
</script>

@endsection