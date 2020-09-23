@extends('layouts.app_afterLogin')
 
@section('content')
<?php 
    // echo "<pre>";
    // print_r($job_count['job_count']);
    // exit;
    // echo "<pre>";
    // print_r($appliedjobs);
    // exit;
?>
<style type="text/css">
    
    /*.table-bordered>thead>tr>th {
        border-bottom-width: 22px;
    }
    .dataTables_paginate .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #337ab7;
        border-color: #337ab7;
    }*/
        
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
                                $name = $profileimg[0]->profile_path;
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
                        <div class="dashboard-avatar-text" style="">
                            <h4 style="text-transform: capitalize;">{{ $user = Session::get('userName') }}</h4>
                        </div>
                        <div style="position: relative;bottom:35px;right: 30%;">
                            @if(isset($user))
                            <span class="activeStatus"></span>                            
                            @endif
                        </div>
                    </div>
                    
                    <div class="dashboard-menu">
                        <ul>
                            <li class="active"><a href="{{ route('cand.dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a></li>
                            @if($profileimg[0]->candidate_status == 0)
                            <li><a href="{{ route('cand.profile') }}"><i class="ti-ruler-pencil"></i>Create Profile</a></li>
                            @endif
                            @if($profileimg[0]->candidate_status == 1)
                            <li><a href="{{ route('cand.edit') }}"><i class="ti-briefcase"></i>Update Profile</a></li>
                            <li><a href="{{ route('cand.applylist') }}"><i class="ti-briefcase"></i>Job Applications</a></li>
                            <li><a href="{{ route('endorsment.docs') }}"><i class="ti-briefcase"></i>Documents</a></li>
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
                
                <div class="dashboard-body">
                        <!-- Flash Msg on success-->
                    @if(isset($activate))
                        <div class="msg alert alert-success alert-dismissable fade in" style="padding-bottom: 3%;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <b>Success ! </b>{{ isset($activate['activate']) }}
                        </div>
                    @endif
                    @if( session('success') )
                        <div class="msg alert alert-success alert-dismissable fade in" style="padding-bottom: 3%;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <b>Success ! </b>{{ session('success') }}
                        </div>
                    @endif

                    <!-- Flash Msg on success-->
                    @if( session('error'))
                        <div class="msg alert alert-danger alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <b>Error ! </b>{{ session('error') }}
                        </div>
                    @endif
                    @if( isset($profileimg[0]->candidate_status) && ($profileimg[0]->candidate_status == 0) )
                        <div class="alert alert-danger alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <b>Error ! </b>{{ 'Activate your profile by creating your profile.' }}
                        </div>
                    @endif
                    <div class="dashboard-caption">
                        
                        <div class="dashboard-caption-header">
                            <h4><i class="ti-settings"></i>Dashboard</h4>
                        </div>
                        
                        <div class="dashboard-caption-wrap">
                        
                            <!-- Overview -->
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-1">
                                        <div class="dashboard-stat-content">
                                            <h4>{{ $job_count['job_count'] }}</h4> 
                                            <span>Applied Job</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-2">
                                        <div class="dashboard-stat-content">
                                            <h4>0</h4>
                                            <span>Profile Viewed</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-layers"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-3">
                                        <div class="dashboard-stat-content">
                                            <h4>{{ $shortlist_count }}</h4> 
                                            <span>Short Listed</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-4">
                                        <div class="dashboard-stat-content">
                                            <h4>{{ $interviewcall_count }}</h4> 
                                            <span>Call For Interview</span>
                                        </div>
                                        <div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
                                    </div>	
                                </div>
                            </div>
                            
                            <!-- Notifications --> 
                            <div style="text-align: center;margin:2% 0; ">
                                <h3>Job Applied By You</h3>
                            </div>

                            <table id="candidate_jobpost_tbl" class="display table table-striped table-bordered dataTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Employer</th>                                        
                                        <th>Application Deadline</th>
                                        <th>Country</th>
                                        <th>Rank</th>
                                        <th>Application Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appliedjobs as $job)
                                        <tr>
                                            <td>{{ mb_strimwidth($job->job_title, 0, 15, "...")  }}</td>
                                            <td>{{ mb_strimwidth($job->name, 0, 15,'...') }}</td>
                                            <td>{{ date('m/d/Y', strtotime($job->app_deadline)) }}</td>
                                            <td>{{ mb_strimwidth($job->country,0,15,'...') }}</td>
                                            <td>{{ mb_strimwidth($job->rank_position,0,15,'...') }}</td>
                                            <td>
                                                <?php 
                                                if($job->apply_status == 0){
                                                    echo '<label class="label label-primary">Pending</label>';
                                                }else if($job->apply_status == 1){
                                                    echo '<label class="label label-success">Selected</label>';
                                                }else if($job->apply_status == 2){
                                                    echo '<label class="label label-default">Shotlisted</label>';
                                                }else if($job->apply_status == 3){
                                                    echo '<label class="label label-warning">Called For Interview</label>';
                                                }else if($job->apply_status == 4){
                                                    echo '<label class="label label-info">Under review</label>';
                                                }else if($job->apply_status == 5){
                                                    echo '<label class="label label-danger">Rejected</label>';
                                                }
                                                 ?>
                                                
                                            </td>
                                        </tr>    
                                    @endforeach
                                    <!-- <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr> -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Employer</th>                                        
                                        <th>Application Deadline</th>
                                        <th>Country</th>
                                        <th>Rank</th>
                                        <th>Application Status</th>
                                    </tr>
                                </tfoot>
                            </table>
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
    $('#candidate_jobpost_tbl').DataTable();
    //resume upload 
    $(function() {
      $('input[type=file]').change(function(){
        var t = $(this).val();
        var labelText = 'File : ' + t.substr(12, t.length);
        $(this).prev('label').text(labelText);
      })
    });
</script>

@endsection