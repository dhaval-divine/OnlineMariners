@extends('layouts.app')

@section('content')
    <section class="inner-header-title" style="background-image:url(public/assets/img/bn2.jpg);">
        <div class="container">
            <h1>Create And Account</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <section class="tab-sec gray">
        <div class="container">
            <div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-2 col-md-offset-2">
                <div id="usertabs" class="new-logwrap">
                
                <ul class="nav modern-tabs nav-tabs theme-bg usertabs" id="simple-design-tab">
                    <li class="active"><a href="#candidate">Candidate</a></li>
                    <li id='employer'><a href="#employer">Employer</a></li>
                </ul>
                
                <div class="tab-content">
                    <div id="candidate" class="tab-pane fade in active">
                        <form method="POST" action="{{ route('signup.create') }}">
                            @csrf
                            <input type='hidden' id='user-type' name='user-type' value='candidate'>
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-with-icon">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
                                    value="{{ old('name') }}" placeholder="Enter Your Username">
                                    <i class="theme-cl ti-user"></i>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-with-icon">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                                    value="{{ old('email') }}" autocomplete="email" placeholder="Enter Your Email">
                                    <i class="theme-cl ti-email"></i>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-with-icon">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                     value="{{ old('password') }}" autocomplete="new-password" placeholder="Enter Your Password">
                                    <i class="theme-cl ti-lock"></i>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-with-icon">
                                    <input type="password" name="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter Confirm Password">
                                    <i class="theme-cl ti-lock"></i>
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback error-msg" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="register-account text-center">
                                By hitting the <span class="theme-cl">"Register"</span> button, you agree to the <a class="theme-cl" href="#">Terms conditions</a> and <a class="theme-cl" href="#">Privacy Policy</a>
                            </div>
                            
                            <div class="form-groups">
                                <button type="submit" class="btn btn-primary theme-bg full-width">Register</button>
                            </div>
                        </form>

                        <div class="social-devider">
                            <span class="line"></span>
                            <span class="circle">Or</span>
                        </div>
                        <div class="social-login row">
                            
                            <div class="col-md-6">
                                <a href="{{ route('fb.redirect','facebook') }}" class="jb-btn-icon social-login-facebook"><i class="fa fa-facebook"></i>Facebook</a>
                            </div>
                            
                            <div class="col-md-6">
                                <a href="{{ route('fb.redirect','google') }}" class="jb-btn-icon social-login-google"><i class="fa fa-google-plus"></i>Google</a>
                            </div>
                            <!--
                            <div class="col-md-6">
                                <a href="#" class="jb-btn-icon social-login-twitter"><i class="fa fa-twitter"></i>Twitter</a>
                            </div>
                            
                            <div class="col-md-6">
                                <a href="#" class="jb-btn-icon social-login-linkedin"><i class="fa fa-linkedin"></i>Linkedin</a>
                            </div>
                            -->
                        </div>
                    </div>
                    
                    <div id="employer" class="tab-pane fade">
                        <div class="form-group">
                            <label>User Name</label>
                            <div class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Enter Your Username">
                                <i class="theme-cl ti-user"></i>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Company Name</label>
                            <div class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Enter Your Username">
                                <i class="theme-cl ti-home"></i>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-with-icon">
                                <input type="email" class="form-control" placeholder="Enter Your Email">
                                <i class="theme-cl ti-email"></i>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-with-icon">
                                <input type="password" class="form-control" placeholder="Enter Your Password">
                                <i class="theme-cl ti-lock"></i>
                            </div>
                        </div>
                        
                        <div class="register-account text-center">
                            By hitting the <span class="theme-cl">"Register"</span> button, you agree to the <a class="theme-cl" href="#">Terms conditions</a> and <a class="theme-cl" href="#">Privacy Policy</a>
                        </div>
                        
                        <div class="form-groups">
                            <button type="submit" class="btn btn-primary theme-bg full-width">Register</button>
                        </div>
                        
                        <div class="social-devider">
                            <span class="line"></span>
                            <span class="circle">Or</span>
                        </div>
                        
                        <div class="social-login row">
                            
                            <div class="col-md-6">
                                <a href="{{ route('fb.redirect','facebook') }}" class="jb-btn-icon social-login-facebook"><i class="fa fa-facebook"></i>Facebook</a>
                            </div>
                            
                            <div class="col-md-6">
                                <a href="{{ route('fb.redirect','google') }}" class="jb-btn-icon social-login-google"><i class="fa fa-google-plus"></i>Google</a>
                            </div>
                            <!--
                            <div class="col-md-6">
                                <a href="#" class="jb-btn-icon social-login-twitter"><i class="fa fa-twitter"></i>Twitter</a>
                            </div>
                            
                            <div class="col-md-6">
                                <a href="#" class="jb-btn-icon social-login-linkedin"><i class="fa fa-linkedin"></i>Linkedin</a>
                            </div>
                            -->
                        </div>
                        
                    </div>
                    
                </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom_js_usertype')
<script type="text/javascript">
    $(document).ready(function(){

        var userType = $(".usertabs li.active a").text();
        // alert('active user '+ userType);
        // user want to be employeer
        $("#employer").on("click", function() {
            $('#user-type').val('employer');
        });
    });
</script>
@endsection