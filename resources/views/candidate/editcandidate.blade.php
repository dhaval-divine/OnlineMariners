
<?php 
use Illuminate\Support\Facades\Input;


if($candidateData){
    $code = explode("-", isset($candidateData->phone_number) ? $candidateData->phone_number : '');

    $country_code = isset($code[0]) ? $code[0] : '' ;
    $phone_number = isset($code[1]) ? $code[1] :  '';
    // echo "<pre>";
    // print_r($candidateData);
    // var_dump($candidateData->dob != '');

    // exit;
    if($candidateData->dob != ''){
        $dateInput = explode('-', isset($candidateData->dob) ? $candidateData->dob : '');    
    }
    
    // echo $dateInput;
    // var_dump();
    if(isset($dateInput) && ($dateInput != null)){
        $dob = $dateInput[1].'/'.$dateInput[2].'/'.$dateInput[0];
    }else{
        $dob = '';
    }
    if($candidateData->availablefrom != '' && isset($candidateData->availablefrom)){
        $date = explode('-',isset($candidateData->availablefrom) ? $candidateData->availablefrom : '');    
    }
    
    if(isset($date) && $date != ''){
        $availablefrom = $date[1].'/'.$date[2].'/'.$date[0];    
    }else{
        $availablefrom = '';
    }
}

// echo '<pre>';
// print_r(explode("-",$candidateData->phone_number));
// print_r($candidateData->nationality);
// exit;
?>
@extends('layouts.app_afterLogin')
@section('content')
    <section class="dashboard-wrap">
        <div class="container-fluid">
                    <div class="row">
                        <!-- Sidebar Wrap -->
                        <div class="col-lg-3 col-md-4">
                            <div class="side-dashboard">
                                <?php //echo url('public/assets/img/avatar-default.png')?>
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
                                        <!-- <span>Zivara Technoloty</span> -->
                                    </div>
                                    <!-- profile pic -->
                                    <form class="candidate-profile-form" method="POST" action="{{ route('cand.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <span class="control-fileupload">
                                            <label for="file">Update Profile Image</label>
                                            <input type="file" name="profile_path" id="profile_path">

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="dashboard-menu">
                                    <ul>
                                        <li><a href="{{ route('cand.dashboard') }}"><i class="ti-dashboard"></i>Dashboard</a></li>
                                        @if($profileimg[0]->candidate_status == 0)
                                        <li><a href="{{ route('cand.profile') }}"><i class="ti-ruler-pencil"></i>Create Profile</a></li>
                                        @endif
                                        @if($profileimg[0]->candidate_status == 1)
                                        <li class="active">
                                            <a href="{{ route('cand.edit') }}"><i class="ti-briefcase"></i>Update Profile</a></li>
                                        @endif
                                        <li><a href="{{ route('cand.applylist') }}"><i class="ti-briefcase"></i>Job Applications</a></li>
                                        <li><a href="{{ route('endorsment.docs') }}"><i class="ti-briefcase"></i>Documents</a></li>
                                        <!-- <li><a href=""><i class="ti-briefcase"></i>All Jobs</a></li>
                                        <li><a href=""><i class="ti-user"></i>Applications</a></li>
                                        <li><a href=""><i class="ti-wallet"></i>Packages</a></li>
                                        <li><a href=""><i class="ti-cup"></i>Choose Packages</a></li>
                                        <li><a href=""><i class="ti-flag-alt-2"></i>Viewed Resume</a></li>
                                        <li><a href=""><i class="ti-id-badge"></i>Edit Profile</a></li> -->
                                        
                                       <!--  <li><a href=""><i class="ti-power-off"></i>Logout</a></li> -->
                                    </ul>
                                    <!-- <h4>For Candidate</h4>
                                    <ul>
                                        <li><a href=""><i class="ti-dashboard"></i>Candidate Dashboard</a></li>
                                        <li><a href=""><i class="ti-wallet"></i>My Resume</a></li>
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
                                @if( session('success') )
                                    <div class="alert alert-success alert-dismissable fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <b>Success ! </b>{{ session('success') }}
                                    </div>
                                @endif
                                <!-- Flash Msg on success-->
                                @if( session('error') )
                                    <div class="alert alert-danger alert-dismissable fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <b>Error ! </b>{{ session('error') }}
                                    </div>
                                @endif
                                @if( count($errors) > 0 )
                                    <div class="alert alert-danger alert-dismissable fade in">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <ul>
                                             @foreach ($errors->all() as $error)
                                                 <li style="text-transform: capitalize;">{{ $error }}</li>
                                             @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="dashboard-caption">
                                    
                                    <div class="dashboard-caption-header">
                                        <h4><i class="ti-briefcase"></i>Update Profile</h4>
                                    </div>
                                    
                                    <div class="dashboard-caption-wrap">
                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <label style="font-size:18px !important;">
                                                        <span style="color: red;">*</span> Indicate Mandatory field.
                                                    </label> 
                                                </div>
                                            </div>
 
                                            <!-- row -->
                                            <input type="hidden" name="update_candidate" value="update">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <label>Contact Number<span style="color: red;">*</span></label> 
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <input type="number" name="country_code" class="form-control" placeholder="91" value="{{ isset($country_code) ? $country_code : '' }}">
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                        <input type="number" name="phone_number" class="form-control" placeholder="xxxxxxxxxx" value="{{ isset($phone_number) ? $phone_number : '' }}">
                                                    </div>
                                                </div> 
                                            </div>

                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <?php $uemail = Session::get('userEmail');?>
                                                        <input type="text" class="form-control" value="<?php echo (isset($uemail)) ?  trim($uemail) : ''; ?>"  
                                                        disabled>
                                                    </div>  
                                                </div>
                                            </div>
                                             <!-- row -->
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Nationality<span style="color: red;">*</span></label>
                                                        <select name="nationality" id="jb-nationality" class="form-control">
                                                            <option value=''>Select Country</option>
                                                            @foreach ($countryList as $c)
                                                            <!-- <option value="{{ $c->countryname }}">{{ $c->countryname }}</option> -->
                                                            @if ($candidateData->nationality == $c->countryname)
                                                                <option value="{{ $c->countryname }}" selected>{{ $c->countryname }}</option>
                                                            @else
                                                                 <option value="{{ $c->countryname }}">{{ $c->countryname }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>  
                                                </div>
                                            </div>


                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label>Date OF Birth<span style="color: red;">*</span></label>
                                                        <input type="text" name="dob" id="candidate-dob" data-lang="en" data-large-mode="true" data-min-year="1950" data-max-year="2020" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" value="{{ $dob }}">
                                                    </div>  
                                                </div>
                                            </div>

                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Current Position<span style="color: red;">*</span></label>
                                                        <select name="applied_for" id="position-appilied-for" class="form-control">
                                                            <option value="">Choose Position</option>
<option value="Captain / Master" {{ $candidateData->applied_for =='Captain / Master' ? 'selected' : ''  }}>Captain / Master</option>
<option value="Chief Engineer" {{ $candidateData->applied_for=='Chief Engineer' ? 'selected' : ''  }}>Chief Engineer</option>
<option value="Chief Officer" {{ $candidateData->applied_for=='Chief Officer' ? 'selected' : ''  }}>Chief Officer</option>
<option value="2 nd Engineer" {{ $candidateData->applied_for=='2nd Engineer' ? 'selected' : ''  }}>2nd Engineer</option>
<option value="2 nd Officer" {{ $candidateData->applied_for=='2nd Officer' ? 'selected' : ''  }}>2nd Officer</option>
<option value="3 rd Engineer" {{ $candidateData->applied_for=='3rd Engineer' ? 'selected' : ''  }}>3rd Engineer</option>
<option value="3 rd Officer" {{ $candidateData->applied_for=='3rd Officer' ? 'selected' : ''  }}>3rd Officer</option>
<option value="4 th Engineer" {{ $candidateData->applied_for=='4th Engineer' ? 'selected' : ''  }}>4th Engineer</option>
<option value="Electrical Officer" {{ $candidateData->applied_for=='Electrical Officer' ? 'selected': ''  }}>Electrical Officer</option>
<option value="Electrical Technical Officer" {{ $candidateData->applied_for=='Electrical Technical Officer' ? 'selected' : ''  }}>Electrical Technical Officer</option>
<option value="Trainee Electrical Officer" {{ $candidateData->applied_for=='Trainee Electrical Officer' ? 'selected' : ''  }}>Trainee Electrical Officer</option>
<option value="AB" {{ $candidateData->applied_for=='AB' ? 'selected' : ''  }}>AB</option>
<option value="Oiler" {{ $candidateData->applied_for=='Oiler' ? 'selected' : ''  }}>Oiler</option>
<option value="Deck Cadet" {{ $candidateData->applied_for=='Deck Cadet' ? 'selected' : ''  }}>Deck Cadet</option>
<option value="Engine Cadet" {{ $candidateData->applied_for=='Engine Cadet' ? 'selected' : ''  }}>Engine Cadet</option>
<option value="OS" {{ $candidateData->applied_for=='OS' ? 'selected' : ''  }}>OS</option>
<option value="Wiper" {{ $candidateData->applied_for=='Wiper' ? 'selected' : ''  }}>Wiper</option>
<option value="Trainee OS" {{ $candidateData->applied_for=='Trainee OS' ? 'selected' : ''  }}>Trainee OS</option>
<option value="Trainee Wiper" {{ $candidateData->applied_for=='Trainee Wiper' ? 'selected' : ''  }}>Trainee Wiper</option>
<option value="Deck Fitter" {{ $candidateData->applied_for=='Deck Fitter' ? 'selected' : ''  }}>Deck Fitter</option>
<option value="Engine Fitter" {{ $candidateData->applied_for=='Engine Fitter' ? 'selected' : ''  }}>Engine Fitter</option>
<option value="Bosun" {{ $candidateData->applied_for=='Bosun' ? 'selected' : ''  }}>Bosun</option>
<option value="Pumpman" {{ $candidateData->applied_for=='Pumpman' ? 'selected' : ''  }}> Pumpman</option>
<option value="Motorman" {{ $candidateData->applied_for=='Motorman' ? 'selected' : ''  }}>Motorman</option>
<option value="Crane Operator" {{ $candidateData->applied_for=='Crane Operator' ? 'selected' : ''  }}>Crane Operator</option>
<option value="Chief Cook" {{ $candidateData->applied_for=='Chief Cook' ? 'selected' : ''  }}>Chief Cook</option>
<option value="Cook" {{ $candidateData->applied_for=='Cook' ? 'selected' : ''  }}>Cook</option>
<option value="2nd Cook" {{ $candidateData->applied_for=='2nd Cook' ? 'selected' : ''  }}>2nd Cook</option>
<option value="Assistant Cook" {{ $candidateData->applied_for=='Assistant Cook' ? 'selected' : ''  }}>Assistant Cook</option>
<option value="General Steward" {{ $candidateData->applied_for=='General Steward' ? 'selected' : ''  }}>General Steward</option>
<option value="Trainee General Steward" {{ $candidateData->applied_for=='Trainee General' ? 'selected' : ''  }}>Trainee General Steward</option>
                                                        </select>
                                                    </div>  
                                                </div>
                                            </div>
                                            

                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                         <label>My Rank Experience is of<span style="color: red;">*</span> </label>
                                                    </div>  
                                                </div>  
                                                    <div class="col-lg-4  col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                        <label>No Of Years<span style="color: red;">*</span></label>
                                                        <select name="experience_years" id="experience_years" class="form-control">
                                                            <option value=''>No of years</option>
                                                            <option value='0' {{ $candidateData->experience_years =='0' ? 'selected' : ''  }}>0</option>
                                                            <option value='1'{{ $candidateData->experience_years=='1' ? 'selected' : ''  }}>1</option>
                                                            <option value='2'{{ $candidateData->experience_years=='2' ? 'selected' : ''  }}>2</option>
                                                            <option value='3'{{ $candidateData->experience_years=='3' ? 'selected' : ''  }}>3</option>
                                                            <option value='4'{{ $candidateData->experience_years=='4' ? 'selected' : ''  }}>4</option>
                                                            <option value='5'{{ $candidateData->experience_years=='5' ? 'selected' : ''  }}>5</option>
                                                            <option value='6'{{ $candidateData->experience_years=='6' ? 'selected' : ''  }}>6</option>
                                                            <option value='7'{{ $candidateData->experience_years=='7' ? 'selected' : ''  }}>7</option>
                                                            <option value='8'{{ $candidateData->experience_years=='8' ? 'selected' : ''  }}>8</option>
                                                            <option value='9'{{ $candidateData->experience_years=='9' ? 'selected' : ''  }}>9</option>
                                                            <option value='10'{{ $candidateData->experience_years=='10' ? 'selected' : ''  }}>10</option>
                                                            <option value='11'{{ $candidateData->experience_years=='11' ? 'selected' : ''  }}>11</option>
                                                            <option value='12'{{ $candidateData->experience_years=='12' ? 'selected' : ''  }}>12</option>
                                                        </select>
                                                    
                                                        </div>
                                                    </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>No Of Months<span style="color: red;">*</span></label>
                                                        <select name="experience_months" id="jb-experience-months" class="form-control">
                                                            <option value=''>No of month</option>
                                                            <option value='0' {{ $candidateData->experience_months=='0' ? 'selected' : ''  }}>0</option>
                                                            <option value='1'{{ $candidateData->experience_months=='1' ? 'selected' : ''  }}>1</option>
                                                            <option value='2'{{ $candidateData->experience_months=='2' ? 'selected' : ''  }}>2</option>
                                                            <option value='3'{{ $candidateData->experience_months=='3' ? 'selected' : ''  }}>3</option>
                                                            <option value='4'{{ $candidateData->experience_months=='4' ? 'selected' : ''  }}>4</option>
                                                            <option value='5'{{ $candidateData->experience_months=='5' ? 'selected' : ''  }}>5</option>
                                                            <option value='6'{{ $candidateData->experience_months=='6' ? 'selected' : ''  }}>6</option>
                                                            <option value='7'{{ $candidateData->experience_months=='7' ? 'selected' : ''  }}>7</option>
                                                            <option value='8'{{ $candidateData->experience_months=='8' ? 'selected' : ''  }}>8</option>
                                                            <option value='9'{{ $candidateData->experience_months=='9' ? 'selected' : ''  }}>9</option>
                                                            <option value='10'{{ $candidateData->experience_months=='10' ? 'selected' : ''  }}>10</option>
                                                            <option value='11'{{ $candidateData->experience_months=='11' ? 'selected' : ''  }}>11</option>
                                                            <option value='12'{{ $candidateData->experience_months=='12' ? 'selected' : ''  }}>12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="form-group">
                                                        <label>I am available from<span style="color: red;">*</span></label>
                                                        <input type="text" name="availablefrom" id="availablefrom" data-lang="en" data-large-mode="true" data-min-year="2020" data-max-year="" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" 
                                                        value="{{ $availablefrom }}">
                                                    </div>  
                                                </div>
                                            </div>


                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>I hold a Valid USA Visa (C1/D)<span style="color: red;">*</span></label>
                                                        <!-- <div class="col-lg-4 col-md-6 col-sm-12"> -->
                                                          <input name="usavisa_c1d" type="radio" value="yes" name="optradio" >Yes
                                                        <!-- </div> -->
                                                        <!-- <div class="col-lg-4 col-md-6 col-sm-12"> -->
                                                          <input name="usavisa_c1d" type="radio" value="no" name="optradio" checked>No
                                                        <!-- </div> -->
                                                    </div>  
                                                </div>
                                            </div>
                                            
                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>I hold a Certificate of Competency / Watch keeping from<span style="color: red;">*</span>
                                                        </label>
                                                        <select name="competency_certificate" id="jb-category" class="form-control">
                                                            <option value=''>Select Certificate of Competency</option>
                                                            <option value='Not Applicable' {{ $candidateData->competency_certificate=='Not Applicable' ? 'selected' : ''  }}>Not Applicable</option>
                                                            <option value='India' {{ $candidateData->competency_certificate=='India' ? 'selected' : ''  }}>India</option>
                                                            <option value='UK' {{ $candidateData->competency_certificate=='UK' ? 'selected' : ''  }}>UK</option>
                                                            <option value='Panama' {{ $candidateData->competency_certificate=='Panama' ? 'selected' : ''  }}>Panama</option>
                                                            <option value='Singapore' {{ $candidateData->competency_certificate=='Singapore' ? 'selected' : ''  }}>Singapore</option>
                                                            <option value='New Zealand' {{ $candidateData->competency_certificate=='New Zealand' ? 'selected' : ''  }}>New Zealand</option>
                                                            <option value='Australia' {{ $candidateData->competency_certificate=='Australia' ? 'selected' : ''  }}>Australia</option>
                                                            <option value='Honduras' {{ $candidateData->competency_certificate=='Honduras' ? 'selected' : ''  }}>Honduras</option>
                                                        </select>
                                                    </div>  
                                                </div>
                                            </div>

                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Current Vessel served is<span style="color: red;">*</span></label>
                                                        <select name="last_vassel_served" id="last-vassel-served" class="form-control">
                                                            <option value="">Select vassel served</option>
                                                            <option value="Vessel Type" {{ $candidateData->last_vassel_served=='Vessel Type' ? 'selected' : ''  }}>Vessel Type</option>
                                                            <option value="Tanker Ship" {{ $candidateData->last_vassel_served=='Tanker Ship' ? 'selected' : ''  }}>Tanker Ship</option>
                                                            <option value="Container Ship"{{ $candidateData->last_vassel_served=='Container Ship' ? 'selected' : ''  }}>Container Ship</option>
                                                            <option value="General Cargo Ship"{{ $candidateData->last_vassel_served=='General Cargo Ship' ? 'selected' : ''  }}>General Cargo Ship</option>
                                                            <option value="Bulk Carrier" {{ $candidateData->last_vassel_served=='Bulk Carrier' ? 'selected' : ''  }}>Bulk Carrier</option>
                                                            <option value="Car Carrier / Ro-Ro Ship" {{ $candidateData->last_vassel_served=='Car Carrier / Ro-Ro Ship' ? 'selected' : ''  }}>Car Carrier / Ro-Ro Ship</option>
                                                            <option value="Live-Stock Carrier" {{ $candidateData->last_vassel_served=='Live-Stock Carrier' ? 'selected' : ''  }}>Live-Stock Carrier</option>
                                                            <option value="Passenger Ship" {{ $candidateData->last_vassel_served=='Passenger Ship' ? 'selected' : ''  }}>Passenger Ship</option>
                                                            <option value="Offshore Ship" {{ $candidateData->last_vassel_served=='Offshore Ship' ? 'selected' : ''  }}>Offshore Ship</option>
                                                            <option value="Special Purpose Ship" {{ $candidateData->last_vassel_served=='Special Purpose Ship' ? 'selected' : ''  }}>Special Purpose Ship</option>
                                                            <option value="Other Ship"{{ $candidateData->last_vassel_served=='Other Ship' ? 'selected' : ''  }}>Other Ship </option>
                                                        </select>
                                                    </div>  
                                                </div>
                                            </div>

                                            <!-- row -->
                                            <!-- row -->
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <label>Vassel Size<span style="color: red;">*</span></label> 
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <input type="number" name="vassel_dwt" class="form-control" placeholder="DWT  Size" value="{{ $candidateData->vassel_dwt }}">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <input type="number" name="vassel_grt" class="form-control" placeholder="GRT  size" value="{{ $candidateData->vassel_dwt }}">
                                                    </div>
                                                </div> 
                                            </div>

                                            
                                            <!-- row -->
                                            <div class="row mrg-top-20" style="ma">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <label>My CV / Resume <span style="color: red;">*</span></label> 
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <span class="control-fileupload">
                                                        <label for="file">My CV / Resume</label>
                                                        <input type="file" name="resume_file" id="resume_file" value="{{ old('resume_file') }}">
                                                        </span>
                                                    </div>  
                                                </div>
                                            </div>
                                            
                                            

                                            <!-- row -->
                                            <div class="row mrg-top-30">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn-savepreview"><i class="ti-angle-double-right"></i>Publish </button>
                                                    </div>  
                                                </div>
                                            </div>

                                            
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
    </section>
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