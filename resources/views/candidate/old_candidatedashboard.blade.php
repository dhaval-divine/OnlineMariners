@extends('layouts.app_afterLogin')
 
@section('content')
<?php 
    // echo "<pre>";
    // print_r($job_count['job_count']);
    // exit;
?>
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
                        <div class="dashboard-avatar-text">
                            <h4 style="text-transform: capitalize;">{{ Session::get('userName') }}</h4>
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
                                            <span>Job Posted</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-2">
                                        <div class="dashboard-stat-content">
                                            <h4>{{ $pending_job }}</h4>
                                            <span>Pending Jobs</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-layers"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-3">
                                        <div class="dashboard-stat-content">
                                            <h4>712</h4> 
                                            <span>Total Views</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-4">
                                        <div class="dashboard-stat-content">
                                            <h4>107</h4> 
                                            <span>Expire Jobs</span>
                                        </div>
                                        <div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
                                    </div>	
                                </div>
                            </div>
                            
                            <!-- Notifications -->
                            <!-- <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="dashboard-gravity-list with-icons">
                                        <h4>Recent Activities</h4>
                                        <ul>
                                            <li>
                                                <i class="dash-icon-box ti-layers"></i> Your job <strong><a href="#">App Developer</a></strong> has been approved!
                                                <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                                            </li>

                                            <li>
                                                <i class="dash-icon-box ti-star"></i> Your job <strong><a href="#">Android Developer</a></strong> expire soon!
                                                <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                                            </li>

                                            <li>
                                                <i class="dash-icon-box ti-heart"></i> Someone bookmarked your <strong><a href="#">Web Designer</a></strong> job!
                                                <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                                            </li>

                                            <li>
                                                <i class="dash-icon-box ti-star"></i> Gracie Mahmood left a review <div class="numerical-rating mid" data-rating="3.8"></div> on <strong><a href="#">Sonal Cafe</a></strong>
                                                <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                                            </li>

                                            <li>
                                                <i class="dash-icon-box ti-heart"></i> Your job <strong><a href="#">UI/UX Designer</a></strong> has been approved!
                                                <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                                            </li>

                                            <li>
                                                <i class="dash-icon-box ti-heart"></i> Someone bookmarked your <strong><a href="#">PHP Developer</a></strong> job!
                                                <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                                            </li>

                                            <li>
                                                <i class="dash-icon-box ti-star"></i> Your job <strong><a href="#">Software Developer</a></strong> expire soon!
                                                <a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-12">
                                    <div class="dashboard-gravity-list invoices with-icons">
                                        <h4>Invoices</h4>
                                        <ul>
                                            
                                            <li><i class="dash-icon-box ti-files"></i>
                                                <strong>Starter Plan</strong>
                                                <ul>
                                                    <li class="unpaid">Unpaid</li>
                                                    <li>Order: #20551</li>
                                                    <li>Date: 01/08/2019</li>
                                                </ul>
                                                <div class="buttons-to-right">
                                                    <a href="#" class="button gray">View Invoice</a>
                                                </div>
                                            </li>
                                            
                                            <li><i class="dash-icon-box ti-files"></i>
                                                <strong>Basic Plan</strong>
                                                <ul>
                                                    <li class="paid">Paid</li>
                                                    <li>Order: #20550</li>
                                                    <li>Date: 01/07/2019</li>
                                                </ul>
                                                <div class="buttons-to-right">
                                                    <a href="#" class="button gray">View Invoice</a>
                                                </div>
                                            </li>

                                            <li><i class="dash-icon-box ti-files"></i>
                                                <strong>Extended Plan</strong>
                                                <ul>
                                                    <li class="paid">Paid</li>
                                                    <li>Order: #20549</li>
                                                    <li>Date: 01/06/2019</li>
                                                </ul>
                                                <div class="buttons-to-right">
                                                    <a href="#" class="button gray">View Invoice</a>
                                                </div>
                                            </li>
                                            
                                            <li><i class="dash-icon-box ti-files"></i>
                                                <strong>Platinum Plan</strong>
                                                <ul>
                                                    <li class="paid">Paid</li>
                                                    <li>Order: #20548</li>
                                                    <li>Date: 01/05/2019</li>
                                                </ul>
                                                <div class="buttons-to-right">
                                                    <a href="#" class="button gray">View Invoice</a>
                                                </div>
                                            </li>
                                            
                                            <li><i class="dash-icon-box ti-files"></i>
                                                <strong>Extended Plan</strong>
                                                <ul>
                                                    <li class="paid">Paid</li>
                                                    <li>Order: #20547</li>
                                                    <li>Date: 01/04/2019</li>
                                                </ul>
                                                <div class="buttons-to-right">
                                                    <a href="#" class="button gray">View Invoice</a>
                                                </div>
                                            </li>
                                            
                                            <li><i class="dash-icon-box ti-files"></i>
                                                <strong>Platinum Plan</strong>
                                                <ul>
                                                    <li class="paid">Paid</li>
                                                    <li>Order: #20546</li>
                                                    <li>Date: 01/03/2019</li>
                                                </ul>
                                                <div class="buttons-to-right">
                                                    <a href="#" class="button gray">View Invoice</a>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>	
                            </div> -->
                            
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
    $('#candidate-dob').dateDropper();
    $('#availablefrom').dateDropper();
    $('#expirejob').dateDropper();
    
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