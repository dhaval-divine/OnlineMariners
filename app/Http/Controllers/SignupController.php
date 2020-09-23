<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Candidate;
use App\Models\Employer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailvarificationMail;
use Session;
use DB;
// use Illuminate\Foundation\Auth\RegistersUsers;

class SignupController extends Controller
{
    protected $redirectTo = '/homepage';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('signup');
    }

    public function load()
    {
        return view('userverificationer');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }


    
    public function create(Request $request)
    {
        // // Request $request
        // echo 'signup post<pre>';
        // print_r($request->input());
        // exit;
        $data = $request->input();
        
       $messages = [
            'required' => 'The :attribute field can not be blank.',
            'same:password' => 'Original password and confirm password must be same.',
            'min' => ':arrtibute field must be aleast 6 character long.',
            'regex' => 'Password must be combination of upper, lowercase letter and special symbols like@,#,$ etc.'
       ];
       $validator = $this->validate($request, [
            'name'             => 'required',                        
            'email'            => 'required|email|unique:candidates',     
            'password'         => 'required|min:6|regex:/^(?=.*\d.*\d)[0-9A-Za-z!@#$%*]{6,}$/|confirmed',
            // 'password_confirm' => 'required|min:6|same:password',
        ], $messages);
        
        ///^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/
        if (!$validator) {
            // get the error messages from the validator
            $messages = $validator->messages();
            return Redirect::to('signup.index')->withErrors($validator);   
            // return redirect()->route('signup.index')->withInput($request);       
        }
        if ($validator) {

            if($request['user-type'] == 'employer'){
                $emp_email_token = Str::random(16);
                $url = url('verification/verifyme/'.$request['email'].'/'.$emp_email_token);
                
                $data = [
                    'username' => $request['name'],
                    'email' => $request['email'],
                    'url' =>  $url,
                ];
                // echo "<pre>";
                // print_r($addEmployer);
                
                $addEmployer =  Employer::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'email_token' => $emp_email_token,
                    'created_at' => date('Y-m-d h:i:s', time()),
                    'updated_at' => date('Y-m-d h:i:s', time()),
                ]);
                // print_r($emp_email_token);
                // exit;
                Mail::to($request['email'])->send(new emailvarificationMail($data));
                Session::put('employerEmail', $request['email']);
                Session::put('employerName', $request['name']);
                if($addEmployer){
                    // return redirect()->route('signin.index')->with('success', 'Employer registered successfully.');
                    return redirect()->route('verifying.load')->with('success', 'Candidate registered before preceding futher verify your email by checking your inbox.');
                }
                
            }else{
                $email_token = Str::random(16);
                $url = url('verification/verifyme/'.$request['email'].'/'.$email_token);
                
                $data = [
                    'username' => $request['name'],
                    'email' => $request['email'],
                    'url' =>  $url,
                ];
                // echo '<pre>';
                // print_r($data);
                // exit;
                Mail::to($request['email'])->send(new emailvarificationMail($data));
                // Mail::send('emails.newsinfo', $data, function ($message) use ($data) {
                //     $message->from('no-replymailtrap.com', 'Notify User');
                //     $message->to($data['email']);
                //     $message->subject('Verify Email Address'); 
                //     });
                $addCandidate =  Candidate::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'candidate_status' => 0,
                    'email_token' => $email_token,
                    'created_at' => date('Y-m-d h:i:s', time()),
                    'updated_at' => date('Y-m-d h:i:s', time()),
                ]);
                Session::put('userEmail', $request['email']);
                Session::put('userName', $request['name']);
                
                if ($addCandidate) {                           
                    return redirect()->route('verifying.load')->with('success', 'Candidate registered before preceding futher verify your email by checking your inbox.');
                }   
            }
            
        }
         
    }

    /* Get token and varify user email address */
    public function verifyme($email,$key) {
        // echo "<br>email: ".$email;
        // echo '<br>k:'.$key;
        // exit;
        // $email = Session::get('userEmail');
        $candidateCount = Candidate::where('email', '=', $email)->count();
        if($candidateCount > 0){
            $varified = Candidate::where('email_token','=',$key)->where('email' , $email)->update(['email_verified_at' => 1 ]);
        }
        // var_dump(isset($varified));
        // echo "<br>";
        // exit;

        $employerCount = Employer::where('email', '=', $email)->count();
        if($employerCount > 0){
            $varified_emp = Employer::where('email_token','=',$key)->where('email' , $email)->update(['email_varified' => 1 ]);
        }
        // echo $key;
        // var_dump(isset($varified_emp));
        // exit;
        // $uemail = Candidate::where('email', $email)->first();
        // echo $email.' '.$uemail['id'].'<br>';
        
       
        // echo "<br>".$key.' '.$uemail['id'].'<br>';
        // $data = ['email_verified_at' => 1 ];
        // $varified = DB::table('andidats')
        //     ->where('email', "'".$email."'")
        //     ->where('email_token', "'".$key."'")
        //     ->update($data);
        // var_dump($varified);
        // exit;
        
        if(isset($varified)){
            // echo 'dashboard';
            // exit;
            
            return redirect()->route('cand.dashboard')->with('success', 'Candidate email address varified. Now you create your profile to activate account.');
        }else if(isset($varified_emp)){
            return redirect()->route('employer.dashboard')->with('success', 'Employer email address varified. Now you create your profile to activate account.');      
        }else{
            // echo 'dashboard no';
            // exit;
            return redirect()->route('verifying.load')->with('success', 'Candidate email address varified. Now you can login.');
        }
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
