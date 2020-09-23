<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Employer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailvarificationMail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Socialite;
use DB;

class SigninController extends Controller
{
    
    // use AuthenticatesUsers;
    // protected $redirectTo = '/homepage';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $canidate = Session::get('userEmail');
        $employer = Session::get('employerEmail');
        if(isset($canidate)){
            return redirect()->route('cand.dashboard');
        }if(isset($employer)){
            return redirect()->route('employer.dashboard');
        }else{
           return view('signin'); 
        }  
    }

    public function socialLogin($socialData)
    {  
        // echo '<pre>';
        // print_r($socialData);
        // exit;

        return view('socialsignin')->compact($socialData);
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        // echo 'Hello';
        $user = Socialite::driver($provider)->user();
        $userName = $user->getName();
        // echo '<br>';
        $email = $user->getEmail();
        $socialLogin = [
            'provider' => $provider,
            'email' => $email,
            'username' => $userName,        
        ];
        $socialData = $socialLogin;
        
        $candidateCount = Candidate::where('email', '=', $socialData['email'])->count();
        $employerCount = Employer::where('email', '=', $socialData['email'])->count();

        // if Candidate want social login and it already exist 
        if($candidateCount > 0){
            $candidate = DB::select("SELECT email_verified_at FROM candidates where email="."'".$socialData['email']."'");
            $cand_varify = $candidate[0]->email_verified_at;
            Session::put('userEmail', $socialData['email']);
            Session::put('userName', $socialData['username']);
            if($cand_varify){
                return redirect()->route('cand.dashboard')->with('success', 'Create profile for account activation.');
            }else{
                
            return redirect()->route('verifying.load')->with('success', 'Candidate email address varified. Now you can login.');
            }
        }
        // if Employer want social login and it already exist 
        if($employerCount > 0){
                Session::put('employerName', $socialData['username']);
                Session::put('employerEmail', $socialData['email']);
            return redirect()->route('employer.dashboard')->with('success', 'Create profile for account activation.');
        }

        return view('socialsignin', compact('socialData'));

        // echo '<pre>';
        // print_r($facebookLogin);
        // exit;
        

        // $chooseType = [ 'success' => 'Choose your category are you Candidate Or Employer'];

        // return redirect()->route('social.login')->with([ 'socialData' => $socialData ] );
        // return $this->checkLogin($facebookLogin);       
        // $user->token;
    }
    
    public function checkLogin(Request $request)
    {   
        
        $results = $request->input();
        $pstr  = 'mariners123';
        $email_token = Str::random(16);
        $psw = [
            'password' => Hash::make($pstr),
            'candidate_status' => 0,
            'email_token' => $email_token,
            'created_at' => date('Y-m-d h:i:s', time()),
            'updated_at' => date('Y-m-d h:i:s', time()),
        ];

        $finalResults = array_merge($results, $psw);
        
        
        //user Login with social account
        if (array_key_exists("provider",$results))
        {   
            
            $candidateCount = Candidate::where('email', '=', $finalResults['email'])->count();
            $employerCount = Employer::where('email', '=', $finalResults['email'])->count();
            // dd($candidateCount);
            // exit;
            // $data = [
            //     'username' => $finalResults['name'],
            //     'email' => $finalResults['email'],
            //     // 'url' =>  "http://onlinemariners.com/verification/verifyme/$email_token",
            //     'url' =>  url("/verification/verifyme/$email_token"),
            // ];

            // echo '<pre>';
            // print_r($data);
            // echo 'count : '.$candidateCount.' '.strtolower($results['user_type']).'<br>';
            // var_dump($candidateCount == 0 && (strtolower($results['user_type']) == 'candidate'));
            // echo '<pre>';
            // exit;
            //create candidate account for social login
            if($candidateCount == 0 && (strtolower($results['user_type']) == 'candidate')){
                $candidateDetails = $finalResults;
                $email_token = Str::random(16);
                $url = url('verification/verifyme/'.$finalResults['email'].'/'.$email_token);
                
                foreach($candidateDetails as $k => $v){
                    unset($candidateDetails['_token']);
                    unset($candidateDetails['provider']);
                    unset($candidateDetails['user_type']);                
                    $candidateDetails[$k] = $v;
                    $candidateDetails['email_token'] = $email_token;
                }
                
                $candInserted = DB::table('candidates')->insert($candidateDetails);
                // var_dump($candInserted);
                // exit;
                Session::put('userEmail', $candidateDetails['email']);
                Session::put('userName', $candidateDetails['name']);
                if($candInserted){
                    
                    $url = url('verification/verifyme/'.$finalResults['email'].'/'.$email_token);
                    $data = [
                        'username' => $request['name'],
                        'email' => $request['email'],
                        'url' =>  $url,
                    ];
                    Mail::to($finalResults['email'])->send(new emailvarificationMail($data));
                    

                    return redirect()->route('verifying.load')->with('success', 'Candidate email address varified. Now you can login.');
                }
            }
            /*----------------Employer User-----------------------*/
            if($employerCount == 0 && (strtolower($results['user_type']) == 'employer')){
                $employerDetails = $finalResults;
                 $emp_email_token = Str::random(16);
                $url = url('verification/verifyme/'.$finalResults['email'].'/'.$emp_email_token);
                $data = [
                    'username' => $finalResults['name'],
                    'email' => $finalResults['email'],
                    // 'url' =>  "http://onlinemariners.com/verification/verifyme/$email_token",
                    'url' =>  $url,
                ];
                foreach($employerDetails as $k => $v){
                    unset($employerDetails['_token']);
                    unset($employerDetails['provider']);
                    unset($employerDetails['user_type']);
                    unset($employerDetails['candidate_status']);
                    unset($employerDetails['email_token']);
                    $employerDetails['email_token'] = $emp_email_token;
                    $employerDetails[$k] = $v;
                }
                
                // echo $employerDetails['name'];
                // echo 'emp <pre>';
                // print_r($employerDetails);
                // print_r($data);
                // exit;
                $empInserted = DB::table('employer')->insert($employerDetails);
                // var_dump($empInserted);
                // exit;
                Session::put('employerEmail', $employerDetails['email']);
                Session::put('employerName', $employerDetails['name']);
                if($empInserted){
                    Mail::to($employerDetails['email'])->send(new emailvarificationMail($data));
                    // echo 'Uuu '.Session::get('userEmail');
                    // exit;
                    return redirect()->route('employer.dashboard')->with('success', 'Welcome Employer.');
                }
            }
        }
        else
        {
            //User for normal flow signin 
            $email = $request->input('email');
            $password = $request->input('password');

            $candidateCount = Candidate::where('email', '=', $email)->count();
            $employerCount = Employer::where('email', '=', $email)->count();
            // echo 'Cand: '.$candidateCount.' empl:'.$employerCount;
            // exit;

            
            if($candidateCount == 0 && $employerCount == 0){
                return redirect()->route('signin.index')->with('error', 'User not Exist');
            }
            //if candidate found
            if($candidateCount > 0){
                $candidate = Candidate::where('email', '=', $email)->first();
                
                $emailNotVarified = Candidate::where('email', '=', $email)->where('email_verified_at', '=', 0)->first();
                // var_dump($user);
                if ($candidate == null || $candidate == '') {
                    return redirect()->route('signin.index')->with('error', 'User not Exist');
                }

                if($emailNotVarified){
                    return redirect()->route('signin.index')->with('email', 'Email Not Varified');
                }

                if (!$candidate) {
                    return redirect()->route('signin.index')->with('error', 'Entered email adddress is not valid');
                }

                if (!Hash::check($password, $candidate->password)) {
                    return redirect()->route('signin.index')->with('error', 'Please enter valid password.');
                }
                Session::put('userName', $candidate['name']);
                Session::put('userEmail', $candidate['email']);
                return redirect()->route('cand.dashboard');//->with('success', 'Welcome to user');
            }
            //if employer found
            if($employerCount > 0){
                $employer = Employer::where('email', '=', $email)->first();

                // echo $employer->password.'<br>'.'password'.Hash::check($password, $employer->password);
                // echo '<br>'.$employer->email;
                // exit;
                if ($employer == null || $employer == '') {
                    return redirect()->route('signin.index')->with('error', 'User not Exist');
                }
                if($email !=  $employer['email'] && !(Hash::check($password, $employer->password)) ){
                    return redirect()->route('signin.index')->with('error', 'Plase enter valid email address and password.');
                }
                if($email !=  $employer['email'] && Hash::check($password, $employer->password) ){
                    return redirect()->route('signin.index')->with('error', 'Plase enter valid email address.');
                }
                if ($email ==  $employer['email'] && !Hash::check($password, $employer->password)) {
                    return redirect()->route('signin.index')->with('error', 'Please enter valid password.');
                }
                Session::put('employerName', $employer['name']);
                Session::put('employerEmail', $employer['email']);
                return redirect()->route('employer.dashboard');
            }
        }
        // exit;
        
    }

    public function unverifiedCandidate()
    {
        $email = Session::get('userEmail');
        $currentUser = Candidate::where('email', '=', $email)->first();
        
        $email_token = $currentUser['email_token'];
        $data = [
            'username' => $currentUser['name'],
            'email' => $currentUser['email'],
            'url' =>  "http://localhost/mariners/public/verification/verifyme/$email_token",
        ];
        // echo '<pre>';
        // print_r($data);
        // exit;
        Mail::to($currentUser['email'])->send(new emailvarificationMail($data));
        return redirect()->route('verifying.load')->with('success', 'Candidate before login verify your email first by checking your inbox.');
        // echo '<pre>';
        // print_r($currentUser);
        // exit;
    }

    /* user email links for reset password */
    public function pswlinkResetView()
    {
        return view('resetPassword');
    }

    public function passwordLinkView(Request $request)
    {
        $result = $request->input();

        // $data = [
        //     ''
        // ];
        DB::table('password_resets')->insert();
        print_r($result);
        exit;
        return view('resetPassword');
    }

    public function chagePasswordView()
    {
        return view('changetPassword');
    }    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
