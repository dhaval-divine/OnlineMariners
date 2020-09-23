@extends('layouts.app_afterLogin')
<?php 
    
    
    $city = [];
    foreach ($allPostJobLists as $job) {
        // echo $allPostJobLists[].'<br>';
        // print_r($v);
        // if($allPostJobLists['city'] == 'city'){
            $city[] =  $job->city;           
        // }
    }
    // echo '<pre>';
    // print_r($allPostJobLists);
    // print_r(array_unique($city));
    // exit;
    // $city = array_unique($city);
    // echo '<pre>';
    // print_r($city);
    // $countCity = count($city);
    // for ($i=0; $i <=$countCity ; $i++) { 
    //     echo $avilableCity[$i];
    //     echo '<br>';
    // }
    // exit;
?>
@section('content')
    <!-- <div class="clearfix"></div>             -->
            <!-- Title Header Start -->
            <?php $url =  url('public/assets/img/banner-10.jpg'); ?>
    <section class="inner-header-title" style="background-image:url({{ $url }})">
        <div class="container">
            <h1>Browse Company</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->
        
    <!-- Browse Company List Start -->
    <section class="browse-company">
        <div class="container">
        
            <!-- Company Searrch Filter Start -->
            <div class="row extra-mrg">
                <div class="wrap-search-filter">
                    <form name="job_searchfilter_form" action="{{ route('joblist.companyfilter') }}" method="get">
                        @csrf
                        <div class="col-md-4 col-sm-4">
                            <input type="text" name="company_name" class="form-control" placeholder="Search By Comany Name">
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" id="my-address" name="city" class="form-control" placeholder="Search By City Name">
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select name="rank_position" class="form-control" id="j-category">
                                <option value=""></option>
                                <option value="Captain / Master">Captain / Master</option>
                                <option value="Chief Engineer">Chief Engineer</option>
                                <option value="Chief Officer">Chief Officer</option>
                                <option value="2nd Engineer">2nd Engineer</option>
                                <option value="2nd Officer" >2nd Officer</option>
                                <option value="3rd Engineer">3rd Engineer</option>
                                <option value="3rd Officer" >3rd Officer</option>
                                <option value="4th Engineer">4th Engineer</option>
                                <option value="Electrical Officer">Electrical Officer</option>
                                <option value="Electrical Technical Officer">Electrical Technical Officer</option>
                                <option value="Trainee Electrical Officer">Trainee Electrical Officer</option>
                                <option value="AB">AB</option>
                                <option value="Oiler">Oiler</option>
                                <option value="Deck Cadet">Deck Cadet</option>
                                <option value="Engine Cadet">Engine Cadet</option>
                                <option value="OS">OS</option>
                                <option value="Wiper">Wiper</option>
                                <option value="Trainee OS">Trainee OS</option>
                                <option value="Trainee Wiper">Trainee Wiper</option>
                                <option value="Deck Fitter">Deck Fitter</option>
                                <option value="Engine Fitter">Engine Fitter</option>
                                <option value="Bosun">Bosun</option>
                                <option value="Pumpman"> Pumpman</option>
                                <option value="Motorman">Motorman</option>
                                <option value="Crane Operator">Crane Operator</option>
                                <option value="Chief Cook">Chief Cook</option>
                                <option value="Cook">Cook</option>
                                <option value="2nd Cook">2nd Cook</option>
                                <option value="Assistant Cook">Assistant Cook</option>
                                <option value="General Steward">General Steward</option>
                                <option value="Trainee General Steward">Trainee General Steward</option>
                            </select>

                        </div>
                        <div class="col-md-2 col-sm-2">
                            <button type="submit" class="btn btn-primary full-width">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Company Searrch Filter End -->
            
            <!-- Single Browse Company -->
            @foreach($allPostJobLists as $postjob)
            <div class="item-click">
                <article>
                    <div class="brows-company">
                        <div class="col-md-6 col-sm-6">
                            <div class="item-fl-box">
                                <div class="brows-company-pic">
                                    <?php 
                                        if(isset($postjob->company_logo)){                                            
                                            $companyLogo = url('public/companyLogo/'.$postjob->company_logo);    
                                        }else{
                                            $companyLogo = url('public/assets/img/company_default_logo.png');    
                                        }
                                         ?>                                        
                                    <img src="{{ $companyLogo }}" class="img-responsive" alt="companyLogo" width="100" height="100"/>
                                </div>
                                <div class="brows-company-name">
                                    <h4><a href="{{ route('joblist.browse', [$postjob->company_name,$postjob->city]) }}">{{ $postjob->company_name}}</a></h4>
                                    <span class="brows-company-tagline">{{ $postjob->rank_position}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="brows-company-location">
                                <p><i class="fa fa-map-marker"></i> {{ $postjob->city }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="brows-company-position">                                
                                <p>{{ $postjob->rankcount.' Opening' }}</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
            <!-- No result found then below message display -->
            @if(count($allPostJobLists) < 1)                
                <div class="row" style="text-align: center;padding-top: 5%;">
                    <div class="col-sm-12">
                        <h3 style="color: #03a84e">Requested Data Not Found</h3>
                    </div>
                </div>
            @endif
            <!-- Single Browse Company -->
            <!-- <div class="item-click">
                <article>
                    <div class="brows-company">
                        <div class="col-md-6 col-sm-6">
                            <div class="item-fl-box">
                                <div class="brows-company-pic">
                                    <img src="url('public/assets/img/com-2.jpg')" class="img-responsive" alt="" />
                                </div>
                                <div class="brows-company-name">
                                    <h4><a href="company-detail.html">Google</a></h4>
                                    <span class="brows-company-tagline">Software Company</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="brows-company-location">
                                <p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="brows-company-position">
                                <p>6 Opening</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div> -->
            
            <!-- Single Browse Company -->
            <!-- <div class="item-click">
                <article>
                    <div class="brows-company">
                        <div class="col-md-6 col-sm-6">
                            <div class="item-fl-box">
                                <div class="brows-company-pic">
                                    <img src="url('public/assets/img/com-3.jpg')" class="img-responsive" alt="" />
                                </div>
                                <div class="brows-company-name">
                                    <h4><a href="company-detail.html">Honda</a></h4>
                                    <span class="brows-company-tagline">Motor Agency</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="brows-company-location">
                                <p><i class="fa fa-map-marker"></i> BULLAROOK VIC 3352</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="brows-company-position">
                                <p>6 Opening</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div> -->
            
            <!-- Single Browse Company -->
            <!-- <div class="item-click">
                <article>
                    <div class="brows-company">
                        <div class="col-md-6 col-sm-6">
                            <div class="item-fl-box">
                                <div class="brows-company-pic">
                                    <img src="url('public/assets/img/com-4.jpg')" class="img-responsive" alt="" />
                                </div>
                                <div class="brows-company-name">
                                    <h4><a href="company-detail.html">Honda</a></h4>
                                    <span class="brows-company-tagline">Motor Agency</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="brows-company-location">
                                <p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="brows-company-position">
                                <p>6 Opening</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div> -->
            
            <!-- Single Browse Company -->
            <!-- <div class="item-click">
                <article>
                    <div class="brows-company">
                        <div class="col-md-6 col-sm-6">
                            <div class="item-fl-box">
                                <div class="brows-company-pic">
                                    <img src="url('public/assets/img/com-5.jpg')" class="img-responsive" alt="" />
                                </div>
                                <div class="brows-company-name">
                                    <h4><a href="company-detail.html">Skype</a></h4>
                                    <span class="brows-company-tagline">Software Company</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="brows-company-location">
                                <p><i class="fa fa-map-marker"></i> NUNJIKOMPITA SA 5680</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="brows-company-position">
                                <p>6 Opening</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div> -->
            
            <!-- Single Browse Company -->
            <!-- <div class="item-click">
                <article>
                    <div class="brows-company">
                        <div class="col-md-6 col-sm-6">
                            <div class="item-fl-box">
                                <div class="brows-company-pic">
                                    <img src="url('public/assets/img/com-6.jpg')" class="img-responsive" alt="" />
                                </div>
                                <div class="brows-company-name">
                                    <h4><a href="company-detail.html">Virtue</a></h4>
                                    <span class="brows-company-tagline">Software Company</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="brows-company-location">
                                <p><i class="fa fa-map-marker"></i> JANNALI NSW 2226</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="brows-company-position">
                                <p>6 Opening</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div> -->
            
            <!-- Single Browse Company -->
            <!-- <div class="item-click">
                <article>
                    <div class="brows-company">
                        <div class="col-md-6 col-sm-6">
                            <div class="item-fl-box">
                                <div class="brows-company-pic">
                                    <img src="url('public/assets/img/com-1.jpg')" class="img-responsive" alt="" />
                                </div>
                                <div class="brows-company-name">
                                    <h4><a href="company-detail.html">Twitter</a></h4>
                                    <span class="brows-company-tagline">Software Company</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="brows-company-location">
                                <p><i class="fa fa-map-marker"></i> BOLIVIA NSW 2372</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="brows-company-position">
                                <p>6 Opening</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div> -->
            
            <!-- Single Browse Company -->
            <!-- <div class="item-click">
                <article>
                    <div class="brows-company">
                        <div class="col-md-6 col-sm-6">
                            <div class="item-fl-box">
                                <div class="brows-company-pic">
                                    <img src="url('public/assets/img/com-7.jpg')" class="img-responsive" alt="" />
                                </div>
                                <div class="brows-company-name">
                                    <h4><a href="company-detail.html">Autodesk</a></h4>
                                    <span class="brows-company-tagline">Software Company</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="brows-company-location">
                                <p><i class="fa fa-map-marker"></i> SUNDOWN QLD 4860</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="brows-company-position">
                                <p>6 Opening</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div> -->
            
            <!-- Single Browse Company -->
                <!-- <div class="item-click">
                    <article>
                        <div class="brows-company">
                            <div class="col-md-6 col-sm-6">
                                <div class="item-fl-box">
                                    <div class="brows-company-pic">
                                        <img src="url('public/assets/img/com-2.jpg')" class="img-responsive" alt="" />
                                    </div>
                                    <div class="brows-company-name">
                                        <h4><a href="company-detail.html">Google</a></h4>
                                        <span class="brows-company-tagline">Software Company</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="brows-company-location">
                                    <p><i class="fa fa-map-marker"></i> Street #210, Make New London</p>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="brows-company-position">
                                    <p>6 Opening</p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div> -->
            <!-- Pagination -->
            @if(isset($allPostJobLists))
            <div class="row">
                
                {!! $allPostJobLists->render() !!}
               <!--  <ul class="pagination">
                    <li><a href="#"><i class="ti-arrow-left"></i></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li> 
                    <li><a href="#">4</a></li> 
                    <li><a href="#"><i class="fa fa-ellipsis-h"></i></a></li> 
                    <li><a href="#"><i class="ti-arrow-right"></i></a></li> 
                </ul> -->
            </div>
            @endif
        </div>
    </section>
@endsection