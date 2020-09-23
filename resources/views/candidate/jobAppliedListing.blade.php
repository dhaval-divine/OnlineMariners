@extends('layouts.app_afterLogin')
 
@section('content')
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
                            <li><a href="{{ route('cand.dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a></li>
                            @if($profileimg[0]->candidate_status == 0)
                            <li><a href="{{ route('cand.profile') }}"><i class="ti-ruler-pencil"></i>Create Profile</a></li>
                            @endif
                            @if($profileimg[0]->candidate_status == 1)
                            <li><a href="{{ route('cand.edit') }}"><i class="ti-briefcase"></i>Update Profile</a></li>
                            @endif
                            <li class="active"><a href="{{ route('cand.applylist') }}"><i class="ti-briefcase"></i>Job Applications</a></li>

                            <li>
                                <a href="{{ route('endorsment.docs') }}"><i class="ti-briefcase"></i>Documents</a>
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
                    <div class="msg alert alert-success alert-dismissable fade in" style="padding-bottom: 3%;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <b>Success ! </b>{{ session('success') }}
                    </div>
                @endif
                <!-- Flash Msg on success-->
                @if( session('error') )
                    <div class="msg alert alert-danger alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <b>Error ! </b>{{ session('error') }}
                    </div>
                @endif
                <div class="dashboard-body">
                        
                    <div class="dashboard-caption">
                        
                        <div class="dashboard-caption-header">
                            <h4><i class="ti-settings"></i>JOb Applied</h4>
                        </div>
                        
                        <div class="dashboard-caption-wrap">                        
                            <!-- Overview -->
                            <div class="row">
                                @if(isset($joblist))
                                	<table id="candidate_job_listing" class="display" style="width:100%">
    								        <thead>
    								            <tr>
    								                <th>Job Title</th>
    								                <th>Company Name</th>
    								                <th>Contact Person</th>
                                                    <th>Rank Position</th>								                
    								                <th>Vassel Type</th>
    								                <th>Application Deadline</th>
    								                <th>Application Status</th>
    								            </tr>
    								        </thead>
    								        <tbody>
    								        	@foreach($joblist as $job)
    								            <tr>
    								                <td>{{ $job->job_title }}</td>
    								                <td>{{ $job->company_name }}</td>							        
    								                <td>{{ $job->contact_person }}</td>
                                                    <td>{{ $job->rank_position }}</td>								                
    								                <td>{{ $job->vassel_type }}</td>
    								                <td>{{ date('m-d-Y', strtotime($job->app_deadline)) }}</td>
    								                <td>                                                    
                                                        @if($job->apply_status == 0)
                                                        <label class="label label-default">Pending</label>
                                                        @elseif($job->apply_status == 1)
                                                        <label class="label label-success">Selected</label>
                                                        @elseif($job->apply_status == 2)
                                                        <label class="label label-info">Shortlisted</label>
                                                        @elseif($job->apply_status == 3)
                                                        <label class="label label-warning">Call For Interview</label>
                                                        @elseif($job->apply_status == 4)
                                                        <label class="label label-primary">Under Review</label>
                                                        @elseif($job->apply_status == 5)
                                                        <label class="label label-danger">Rejected</label>
                                                        @endif
    								                </td>
    								            </tr>
    								            @endforeach
    							            </tbody>
    							            <tfoot>
    								            <tr>
    								                <th>Job Title</th>
    								                <th>Company Name</th>
    								                <th>Contact Person</th>
                                                    <th>Rank Position</th>								                
    								                <th>Vassel Type</th>
    								                <th>Application Deadline</th>
    								                <th>Application Status</th>
    								            </tr>
    								        </tfoot>
    						            </table>
                                    @endif
                            </div>
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
	    $('#candidate_job_listing').DataTable();
    });
</script>

@endsection