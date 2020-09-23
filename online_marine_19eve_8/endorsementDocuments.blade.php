@extends('layouts.app_afterLogin')
 
@section('content')
<style type="text/css">
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
                            @endif
                            <li><a href="{{ route('cand.applylist') }}"><i class="ti-briefcase"></i>Job Applications</a></li>
                            <li class="active">
                                <a href="{{ route('endorsment.docs') }}"><i class="ti-briefcase"></i>Endorsements</a>
                            </li>                            
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
                @if( session('success') )
                    <div class="alert alert-success alert-dismissable fade in" style="margin: 1% 0;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <b>Success ! </b>{{ session('success') }}
                    </div>
                @endif
                <!-- Flash Msg on success-->
                @if( session('error') )
                    <div class="alert alert-danger alert-dismissable fade in" style="margin: 1% 0;">
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
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_chemical_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_chemical_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_dec_chemical_dt" id="endors_dec_chemical_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_chemical_dt) ? date('m/d/Y', strtotime($endors->endors_dec_chemical_dt)) : '' }}">
                                                            <!-- <input type="text" name="endors_dec_chemical_dt" id="endors_dec_chemical"  data-lang="en" data-large-mode="true" data-dd-default-date="" data-min-year="1950" data-max-year="2220" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_chemical_dt) ? $endors->endors_dec_chemical_dt : '' }}" /> -->
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
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_gas_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_gas_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_dec_gas_dt" id="endors_dec_gas_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_gas_dt) ? date('m/d/Y', strtotime($endors->endors_dec_gas_dt)) : '' }}" >
                                                            <!-- <input type="text" name="endors_dec_gas_dt" id="endors_dec_gas" data-lang="en" data-large-mode="true" data-min-year="1950" data-max-year="2220" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" value=""/> -->
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
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_others_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_others_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_dec_others_dt" id="endors_dec_others_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_others_dt) ? date('m/d/Y', strtotime($endors->endors_dec_others_dt)) : '' }}" >                                                           
                                                            <!-- <input type="text" name="endors_dec_others_dt" id="endors_dec_others" data-lang="en" data-large-mode="true" data-min-year="1950" data-max-year="2220" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" value=""/> -->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>DCE - Petroleum (Dangerous Cargo Endorsement)
                                                            <input type="hidden" name="endors_name_dec_petroleum" value="DCE - Petroleum">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_petroleum_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_dec_petroleum_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_dec_petroleum_dt" id="endors_dec_petroleum_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_dec_petroleum_dt) ? date('m/d/Y', strtotime($endors->endors_dec_petroleum_dt)) : '' }}">
                                                            <!-- <input type="text" name="endors_dec_petroleum_dt" id="endors_dec_petroleum" data-lang="en" data-large-mode="true" data-min-year="1950" data-max-year="2220" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" value=""/> -->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Others<!-- <b class='mand'>*</b> -->
                                                            <input type="hidden" name="endors_name_others" value="Others">
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_others_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="endors_others_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="endors_others_dt" id="endors_others_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($endors->endors_others_dt) ? date('m/d/Y', strtotime($endors->endors_others_dt)) : '' }}">
                                                            <!-- <input type="text" name="endors_others_dt" id="endors_others" data-lang="en" data-large-mode="true" data-min-year="1950" data-max-year="2220" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" placeholder="Enter Expiry Date" value=""/> -->
                                                        </td>
                                                    </tr>                                    
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
                                                                <label class="radio-inline"> <input type="radio" name="passport_dt_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="passport_dt_require"  value="No" checked> No </label>
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
                                                                <label class="radio-inline"> <input type="radio" name="Seamans_book_cdc_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="Seamans_book_cdc_require"  value="No" checked> No </label>
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
                                                                <label class="radio-inline"> <input type="radio" name="uk_work_permit_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="uk_work_permit_require"  value="No" checked> No </label>
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
                                                                <label class="radio-inline"> <input type="radio" name="us_visa_require"  value="Yes"> Yes </label>                    
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label class="radio-inline"> <input type="radio" name="us_visa_require"  value="No" checked> No </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="us_visa_dt" id="us_visa_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($travel[0]->us_visa_dt) ? date('m/d/Y', strtotime($travel[0]->us_visa_dt    )) : '' }}">                                                           
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                            Others
                                                            <input type="hidden" name="others" value="Others">
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
                                                            <input type="text" name="others_dt" id="others_dt" class="form-control" placeholder="Enter Expiry Date" value="{{ isset($travel[0]->others_dt) ? date('m/d/Y', strtotime($travel[0]->others_dt)) : '' }}">
                                                            
                                                        </td>
                                                    </tr>                                    
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
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>

                                <!--7 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingSeven">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                
                                                STCW
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                        <div class="panel-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>

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
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
            
        $('#endorse_table').DataTable();
        $('#traveldoc_table').DataTable();
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

    });   
</script>

@endsection