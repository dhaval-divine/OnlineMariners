@extends('layouts.app')

@section('content')
    
    <section class="inner-header-title" style="background-image:url('http://onlinemariners.com/public/assets/img/bn2.jpg');">
        <div class="container">
            <h1>Social Login</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <section class="tab-sec gray">
        <div class="container">
        
            <div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-2 col-md-offset-2">
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
                <!-- Email not varify then click below link-->
                @if( session('email') )
                <div class="register-account text-center">
                    <div class="alert alert-success alert-dismissable fade in">
                         <a class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                         <a href="{{ route('signin.emailverify') }}" style="color:blue; font-size:14;">Click here and check you inbox to varify email</a>
                    </div>
                </div>
                @endif
                <!-- End Flash Msg on success-->
                <?php
                        $provider = $socialData['provider'];
                        $username = $socialData['username'];
                        $email = $socialData['email'];
                ?>

                <div class="new-logwrap">
                    <form method="POST" action="{{ route('signin.validate') }}">
                        @csrf
                        
                        <input type="hidden" name="provider" value="{{ $provider }}">
                        <input type="hidden" name="name" value="{{ $username }}">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="row" style="padding: 6% 0 10% 0">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label style="padding: 6% 0 10% 0;font-size: 14px;">Choose your type of Account*</label>
                            </div>
                            <div class="">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <select name="user_type" id="jb-type" class="">
                                        <option value=''>Choose Category</option>
                                        <option value='candidate'>Candidate</option>
                                        <option value='employer'>Employer</option>                            
                                    </select>
                                </div>                        
                            </div>
                        </div>
                        
                        <!-- <div class="form-group">
                            <label>Email</label>
                            <div class="input-with-icon">
                                <input type="hidden" name="email" class="form-control" value="">
                                <input type="hidden" name="username" class="form-control" value="">
                                <i class="theme-cl ti-email"></i>
                            </div>
                        </div> -->

                        <div class="form-groups">
                            <button type="submit" class="btn btn-primary theme-bg full-width">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
