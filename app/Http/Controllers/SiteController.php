<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Country;
use App\Models\JobApply;
use App\Models\Candidate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployerNotifyAppliedPostjob;

class SiteController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/homepage';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // $user = Session::get('userName';
    //     if(!$user){
    //         return View('');
    //     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $emp = DB::select("SELECT id,job_title,app_deadline,company_name  FROM employer where email="."'".$empEmail."'");
        // $joblists = DB::table('postjob')
        //                 ->join('employer','employer.id','=','postjob.employer_id')
        //                 ->select('employer.*','postjob.*')
        //                 ->orderBy('id','DESC')
        //                 ->limit(6)
        //                 ->get();

       $joblists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                // ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->select('employer.*','postjob.*')
                // ->orderBy('id','DESC')
                ->where('postjob.postjob_status', 1)
                ->limit(8)
                ->get();
        // echo '<pre>';
        // print_r($joblists);
        // exit;
        return view('homepage')->with(['joblists' => $joblists]);
    }

    //show candidate detail view of post job
    public function jobDeatils($id)    
    {        
        $postjobs = DB::select("SELECT * FROM postjob where id=".$id);
        
        $wages = DB::select("SELECT * FROM `postjob-wages` where postjob_id=".$id);        
        $emp = DB::select("SELECT * FROM `employer` where id=".$postjobs[0]->employer_id);

        $wagelisting = DB::table('postjob')
                        ->join('employer','employer.id','=','postjob.employer_id')
                        ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                        ->select('employer.*','postjob.*','postjob-wages.*')
                        ->where(['postjob-wages.postjob_id' => $id])
                        // ->orderBy('id','DESC')
                        // ->limit(6)
                        ->get();
        //['countryList' => $countryList, 'profileimg' => $profileimg]
        return view('employer.jobListingView')->with(['postjobs' => $postjobs, 'wages' => $wages, 'emp' => $emp,'wagelisting' => $wagelisting]);
    }

    //candidate apply for the rank is 
    public function listRanks($postjob_id, $postwage_id = null){
        // echo $postjob_id.' '.$postwage_id;
        // exit;
        $postwage_id = request()->segment(5);
        
        $wages = DB::select("SELECT * FROM `postjob-wages` where postjob_id=".$postjob_id);

        $emp = DB::select("SELECT * FROM `employer` where id=".$wages[0]->employer_id);
        $email = session::get('userEmail');
        $candidate = DB::select("SELECT id FROM `candidates` where email="."'".$email."'");
        $candidate_id = $candidate[0]->id;
        

        $ranklists = DB::table('postjob-wages')
                    ->join('postjob','postjob.id','=','postjob-wages.postjob_id')
                    // ->join('jobs_apply','postjob.id','=','jobs_apply.postjob_id')
                    ->select('postjob.job_title','postjob-wages.*')
                    ->where(['postjob-wages.postjob_id' => $postjob_id])
                    // ->where(['jobs_apply.candidate_id' => $candidate_id])
                    ->get();

        $jobs_apply = DB::select("SELECT rank_position FROM `jobs_apply` where postjob_id=".$postjob_id." AND candidate_id=".$candidate_id);
        if($postwage_id){
            $rank = DB::select("SELECT rank_position FROM `postjob-wages` where postjob_id=".$postjob_id." AND id=".$postwage_id);
            // print_r($rank);
            // exit;            
            $add_cRank = ['choose_rank' => $rank[0]->rank_position]; 
            for($i=0;$i<count($ranklists);$i++){
                if($ranklists[$i]->rank_position == $rank[0]->rank_position){
                    $ranklists[$i]->choose_rank = $add_cRank['choose_rank'];                    
                    // array_push($ranklists, $add_cRank);    
                }
            }                    
        }
        // echo '<pre>';   
        // print_r($add_cRank);
        // print_r($ranklists);
        // exit; 

        $add =(object)['rank_position' => ''];        
        if(count($jobs_apply) > 0){
            
            for($i=0;$i<count($ranklists);$i++){                
                if(!isset($jobs_apply[$i]) && (count($jobs_apply) != count($ranklists))){
                    $add = (object)['rank_position' => ''];
                    array_push($jobs_apply, $add);                    
                }                
            }
            // print_r($add_cRank);


            for($i=0;$i<count($ranklists);$i++){   
                           
                $ranklists[$i]->apply_rank = $jobs_apply[$i]->rank_position;                
            }    
        }
       
        $postion_apply = DB::select("SELECT rank_position FROM `jobs_apply` where postjob_id=".(int)$wages[0]->postjob_id." AND employer_id=".(int)$wages[0]->employer_id." AND candidate_id=".(int)$candidate_id."");
        
        return view('candidate.choosePostforApply')->with(['ranklists' => $ranklists, 'emp' => $emp, 'postion_apply' => $postion_apply]);
    }

    //save candidate application rank
    public function saveRank(Request $request){

        $email = Session::get('userEmail');
        // exit;
        $candidateData =  DB::select("SELECT id,name FROM candidates where email="."'".$email."'");
        // echo "<pre>";
        // print_r($candidateData);
        // exit;
        $this->validate($request,['rank_position' => 'required'], 
            ['required' => ':attribute is required.']);

        $employer_id = $request->post('employer_id');
        $postjob_id = $request->post('postjob_id');
        $postwage_id = $request->post('postwage_id');
        $rank_position = $request->post('rank_position');
        $candidate_id = $candidateData[0]->id;
        // exit;
        $data [] = [
            'candidate_id'=> $candidate_id,
            'employer_id' => $employer_id,
            'postjob_id' => $postjob_id,
            'postwage_id' => $postwage_id,
            'rank_position' => $rank_position,
            'apply_status' => 0,
        ];
        $JobApplyCount = 0;
        if(isset($postwage_id) && isset($postjob_id) && isset($postwage_id)){
            $JobApplyCount = JobApply::where('candidate_id', $candidate_id)
                                ->where('employer_id', $employer_id)
                                ->where('postjob_id', $postjob_id)
                                ->where('postwage_id', $postwage_id)
                                ->where('rank_position', $rank_position)
                                ->where('apply_status', 0)
                                ->count();    
        }
        
        // echo 'Apply:  '.$JobApplyCount;
        // exit;
        if($JobApplyCount == 0){
            $saveRank  = DB::table('jobs_apply')->insert($data);
            if($saveRank){
                $emp = DB::select("SELECT id,name,email FROM `employer` where id=".$employer_id);
                $data = ['name' => $emp[0]->name,'candidate_name' => $candidateData[0]->name,'rank_position' => $rank_position,];
                $employerEmail = $emp[0]->email;
                Mail::to($employerEmail)->send(new EmployerNotifyAppliedPostjob($data));
            }   
            $msg = 'You have successfully apply for '.$rank_position;//;    
        }else{
            // readdir()turn route('cand.apply', ['postjob_id' => $postjob_id])->with(['error' => 'You have already apply for the job']);
            return redirect()->to('/candidate/apply/position/'.$postjob_id)->with(['error' => 'You have already apply for the job']);
        }                       
        
        // exit;
        return redirect()->to('/postajob/details/'.$postjob_id)->with(['success' => $msg]);
        // return route('postjob.details', ['postjob_id' =>  $postjob_id])->with(['success' => $msg]);
    }

    //contact Us
    public function contactusView()
    {
        return view('contactus');
    }
    /* load Candidate Dashboard */
    // public function showcandidateDashboard()
    // {
    //     $countryList = DB::select('SELECT countryname FROM country ORDER BY countryname ASC');
    //     $email = Session::get('userEmail');

    //     $profileimg = DB::select("SELECT profile_path FROM candidates where email="."'".$email."'");
        
    //     // echo '<pre>';
    //     // print_r($countryList);
    //     // exit;
    //     return view('candidate.candidatedashboard')->with(['countryList' => $countryList, 'profileimg' => $profileimg]);    
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
