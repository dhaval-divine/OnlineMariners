
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
    <li class="<?php echo(request()->is('employer/postajob')) ? 'active':'' ?>">
    	<a href="{{ route('postjob.index') }}"><i class="ti-ruler-pencil"></i>Post New Job</a>
    </li>
    <li class="<?php echo(request()->is('employer/postajob/listing')) ? 'active':'' ?>">
    	<a href="{{ route('postjob.listing') }}"><i class="ti-user"></i>Post Job Listing And Update</a>
    </li>    
    <li class="<?php echo(request()->is('employer/application/listing')) ? 'active':'' ?>">
        <a href="{{ route('lists.appliedjob') }}"><i class="ti-user"></i>Candidate Job Applied List</a>
    </li>

    <!--
    <li><a href=""><i class="ti-user"></i>Applications</a></li>
    <li><a href=""><i class="ti-wallet"></i>Packages</a></li>
    <li><a href=""><i class="ti-cup"></i>Choose Packages</a></li>
    <li><a href=""><i class="ti-flag-alt-2"></i>Viewed Resume</a></li>
    <li><a href=""><i class="ti-id-badge"></i>Edit Profile</a></li>
    <li><a href=""><i class="ti-power-off"></i>Logout</a></li>
    <!-- <li class="{{-- (request()->is('admin/cities')) ? 'active' : '' --}}">   -->
</ul>
<!-- <h4>For Candidate</h4>
<ul>
<li><a href="candidate-dashboard.html"><i class="ti-dashboard"></i>Candidate Dashboard</a></li>
<li><a href="candidate-resume.html"><i class="ti-wallet"></i>My Resume</a></li>
<li><a href="applied-jobs.html"><i class="ti-hand-point-right"></i>Applied Jobs</a></li>
<li><a href="saved-jobs.html"><i class="ti-heart"></i>Saved Jobs</a></li>
<li><a href="alert-jobs.html"><i class="ti-bell"></i>Alert Jobs</a></li>
</ul> -->