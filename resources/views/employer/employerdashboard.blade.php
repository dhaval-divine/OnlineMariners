@extends('layouts.app_afterLogin')
 
@section('content')
<?php
    // echo '<pre>'; 
    // echo ($postJobByEmp[0]->job_title.'<br>');
    // print_r($postJobByEmp);
    // exit;
// var_dump($empImg[0]->profile_status == 1);
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
                        <form class="emp-img-form"  method="POST" action="{{ route('employer.image') }}" enctype="multipart/form-data">
                            @csrf      
                            <div class="dashboard-avatar-thumb">
                                <?php                                    
                                    $filename = $empImg[0]->pic_path;
                                    $url = url('/public/empProfile/'.$filename); 
                                ?>
                                @if(isset($empImg))
                                    <img src="{{ $url }}" class="img-avater" alt="emp-pic" />
                                @else
                                    <img src="public/assets/img/emp_default.png" class="img-avater" alt="employer-profile-image" />
                                @endif
                                
                            </div>
                            <div class="dashboard-avatar-text">
                                <h4>{{ $user = Session::get('employerName') }}</h4>
                            </div>
                            <div style="position: relative;bottom:35px;right: 30%;">
                                @if(isset($user))
                                <span class="activeStatus"></span>                            
                                @endif
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <span class="control-fileupload">
                                    <label for="file">Update Profile Image</label>
                                    <input type="file" name="pic_path" id="pic_path">
                                    </span>
                                </div>
                            </div>
                            <input type="submit" name="submit" value="Update"> 
                        </form>
                            
                    </div>
                    
                    <div class="dashboard-menu">
                        <!-- include from includes layouts-->
                        <ul>
                            <li class="<?php echo(request()->is('employer/dashboard')) ? 'active':'' ?>">
                                <a href="{{ route('employer.dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a>
                            </li>
                            <li class="<?php echo(request()->is('employer/profile')) ? 'active':'' ?>">
                                <a href="{{ route('employer.profile') }}"><i class="ti-briefcase"></i>Create or Update Profile</a>
                            </li>
                            <!-- <li class="<?php //echo(request()->is('employer/edit')) ? 'active':'' ?>">
                                <a href="{{-- route('employer.edit') --}}"><i class="ti-briefcase"></i>Update Profile</a>
                            </li> -->
                            @if(isset($empImg[0]->profile_status) && ($empImg[0]->profile_status == 1))
                            <li class="<?php echo(request()->is('employer/postajob')) ? 'active':'' ?>">
                                <a href="{{ route('postjob.index') }}"><i class="ti-ruler-pencil"></i>Post New Job</a>
                            </li>
                            <li class="<?php echo(request()->is('employer/postajob/listing')) ? 'active':'' ?>">
                                <a href="{{ route('postjob.listing') }}"><i class="ti-user"></i>Post Job Listing And Update</a>
                            </li>    
                            <li class="<?php echo(request()->is('employer/application/listing')) ? 'active':'' ?>">
                                <a href="{{ route('lists.appliedjob') }}"><i class="ti-user"></i>Candidate Job Applied List</a>
                            </li>
                            @endif
                            <!--
                            <li><a href=""><i class="ti-user"></i>Applications</a></li>
                            <li><a href=""><i class="ti-wallet"></i>Packages</a></li>
                            <li><a href=""><i class="ti-cup"></i>Choose Packages</a></li>
                            <li><a href=""><i class="ti-flag-alt-2"></i>Viewed Resume</a></li>
                            <li><a href=""><i class="ti-id-badge"></i>Edit Profile</a></li>
                            <li><a href=""><i class="ti-power-off"></i>Logout</a></li>
                            <!-- <li class="{{-- (request()->is('admin/cities')) ? 'active' : '' --}}">   -->
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Content Wrap -->
            <div class="col-lg-9 col-md-8">
                <div class="dashboard-body">

                    <!-- Flash Msg on success-->
                    @if( session('success') )
                        <div class="msg alert alert-success alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <b>Success ! </b>{{ session('success') }}
                        </div>
                    @endif

                    
                    @if(isset($empImg[0]->profile_status) && ($empImg[0]->profile_status == 0))
                        <div class="alert alert-danger alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <b>Alert ! </b>{{ 'Active account by create your profile'  }}
                        </div>
                    @endif
                    <div class="dashboard-caption">
                                
                        <div class="dashboard-caption-header">
                            <h4><i class="ti-settings"></i>Dashboard</h4>
                        </div>
                        <?php
                    // echo 'rrr<pre>';
                    //     print_r($empImg);
                    //     var_dump($empImg[0]->profile_status == 0)
                    ?>
                        <div class="dashboard-caption-wrap">
                        
                            <!-- Overview -->
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-1">
                                        <div class="dashboard-stat-content"><h4>{{ $jobPostedCount }}</h4> <span>Active Post Jobs</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-2">
                                        <div class="dashboard-stat-content"><h4>{{ $ShotlistedCandidateCount }}</h4> <span>ShortListed Candidate</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-layers"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-3">
                                        <div class="dashboard-stat-content"><h4>{{ $jobpostCount }}</h4> <span>Total Jobs</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                                    </div>	
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-4">
                                        <div class="dashboard-stat-content"><h4>{{ $activedCandidateCount}}</h4> <span>Active Candidate</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
                                    </div>	
                                </div>
                            </div>
                            

                            <!--  -->
                            <div class="row" style="text-align: center; padding-top: 2%;">
                                <div class="col-sm-12">
                                    <h3 style="color: green;">Job Post List</h3>
                                </div>
                            </div>
                            <table id="employer_active_jobpost_tbl" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Employer</th>
                                        <th>Company Name</th>
                                        <th>Country</th>
                                        <th>Vassel Type</th>
                                        <th>Application Deadline</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($postJobByEmp as $job)
                                        <tr>
                                            <td>{{ $job->job_title }}</td>
                                            <td>{{ $job->employer_name }}</td>
                                            <td>{{ $job->company_name }}</td>
                                            <td>{{ $job->country }}</td>
                                            <td>{{ $job->vassel_type }}</td>
                                            <td>{{ date('m/d/Y',strtotime($job->app_deadline)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Employer</th>
                                        <th>Company Name</th>
                                        <th>Country</th>
                                        <th>Vassel Type</th>
                                        <th>Application Deadline</th>
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
    $('#candidate-dob').dateDropper();
    $('#availablefrom').dateDropper();
    $('#expirejob').dateDropper();
    $('#employer_active_jobpost_tbl').DataTable();

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