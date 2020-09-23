<?php

namespace App\Http\Controllers;
// namespace App\Pagination;
// namespace Illuminate\Pagination\BootstrapThreePresenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use DB;
use App\Models\Employer;
use App\Models\Postjob;
use App\Models\PostjobWages;
use Illuminate\Validation\Rule;

class PostjobController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employer = Session::get('employerEmail');
        if(!isset($employer) || $employer == ''){
            return view('signin');
        }
        $empImg = DB::select("SELECT id,pic_path,email_varified,profile_status  FROM employer where email="."'".$employer."'");
        return view('employer.postjob')->with(['empImg' => $empImg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }
    //list of post job by employer
    public function postjobListing()
    {

        $empEmail = Session::get('employerEmail');

        $emp = DB::select("SELECT id,pic_path,email_varified,profile_status FROM employer where email="."'".$empEmail."'");
        // echo $emp[0]->id;
        // exit;
        $joblist = DB::table('postjob')
                        ->join('employer','employer.id','=','postjob.employer_id')
                        ->select('employer.*','postjob.*')
                        ->where(['postjob.employer_id' => $emp[0]->id])
                        ->get();
        $wagelist = DB::table('postjob')
                        ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                        ->select('postjob.job_title','postjob-wages.*')
                        ->where(['postjob-wages.employer_id' => $emp[0]->id])
                        ->get();
        // dd($joblist);
        // echo "<pre>";
        // print_r($joblist);
        // exit;
        // // print_r($emp[0]['id']);
        
        return view('employer.postjobListing')->with(['joblist' => $joblist, 'empImg' => $emp]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // echo '<pre>';
        // print_r($request->input());
        // print_r($request->file('postjob_banner')); 
         $messages = [
            'required' => ':attribute is required.',
            'integer' => ':attribute is must be number.',
            
        ];
        $this->validate($request,[
            'job_title' => 'required|max:255',
            'job_description' => 'required|max:500',
            'postjob_banner' => 'required|mimes:jpg,jpeg,png,svg|max:2048',
            // 'contract_duration' => 'required|integer|max:12',     
            // 'experience_years' => 'required|integer|min:0',
            // 'experience_months' => 'required|integer|max:12',
            'app_deadline' => 'required|date',
            'vassel_type' => 'required',
            // 'company_name' => 'required',
            // 'email' => 'required|email',
            //  'mobile_no' => 'required|numeric|min:10',
            // 'contact_person' => 'required',
            'address' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'country' => 'required',
            'rank'  => 'required|array|min:1',//'required|array|min:1',
            'wage'  => 'required|array|min:1',
            // 'wage.*'  => 'required|integer',
                ], $messages);       
        $postjobArr = $request->input();
        $empEmail = Session::get('employerEmail');
        
        $employerArr = DB::select("SELECT id FROM employer WHERE email = "."'".$empEmail."'");
        $EmpID =$employerArr[0]->id;
        $emp = [
            'employer_id' => $EmpID,
        ];
        if($request->hasFile('postjob_banner')){
            $files=$request->file('postjob_banner');
            $path = public_path() . '/postjobBanner/';
            // $profile_file = $request->file('profile_pic')->getClientOriginalName();  //name
            $banner_img = time().'.'.$request->file('postjob_banner')->getClientOriginalExtension();

            // echo 'IMG '.$request->file('profile_pic')->getClientOriginalName();;
            $moved = $files->move($path,$banner_img);
            if($moved){
                echo 'file moved';
            }else{
                echo 'not file moved';
            }
            //$oldfile = url('/public/postjob_banner/'.$Employer['postjob_banner']);
            //delete old file
            //File::delete($path.$Employer['postjob_banner']);
            // unset($oldfile);
        }
        // exit;

       
        
        // echo "<pre>";
        // print_r(count($postjobArr));
        // print_r($postjobArr); 
        // exit;
        //array for wage and rank
        $rank  = $postjobArr['rank'];
        $wage = $postjobArr['wage'];
        $contract_duration = $postjobArr['contract_duration'];
        $experience_years = $postjobArr['experience_years'];
        $experience_months = $postjobArr['experience_months'];
        
        $employer = DB::table('employer')->where('email', $empEmail)->get();
        // echo $postjobArr['app_deadline'].'<br>';
        // print_r(count($postjobArr));
        
        foreach ($postjobArr as $k => $v) {
            if($k == 'app_deadline'){    
                $date = $postjobArr['app_deadline'];
                $dateInput = explode('/',$date);
                $deadline = $dateInput[2].'-'.$dateInput[0].'-'.$dateInput[1];
                $postjobArr[$k] = $deadline;
            }

            if($k == 'job_description'){
                print_r($v);
                $postjobArr[$k] = trim($v," ");   
            }
            $postjobArr['postjob_banner'] = $banner_img;
            // $postjobArr[$k] = trim($v);
        }
        // print_r(count($postjobArr));
        // echo "<pre>";
        // print_r($postjobArr); 
        // exit;
        
        unset($postjobArr['_token']);
        unset($postjobArr['_wysihtml5_mode']);
        unset($postjobArr['rank']);
        unset($postjobArr['wage']);
        unset($postjobArr['contract_duration']);
        unset($postjobArr['experience_years']);
        unset($postjobArr['experience_months']);
        $jobsArr = array_merge($emp, $postjobArr);
        foreach($jobsArr as $k=>$v){

            if($k == 'employer_id' || $k == 'contract_duration' || $k == 'experience_years'|| $k == 'experience_months'|| $k == 'mobile_no' || $k == 'app_deadline'){
                $jobsArr[$k] = $v;
            }else{               
               $jobsArr[$k] = trim(strip_tags($v)); 
            }

        }
        
        //Insert to post a job
        $lastJobID = DB::table('postjob')->insertGetId($jobsArr);
        // echo '<br>';print_r($lastJobID);
        // exit;
        //post Job wise wages 
        $a3 = [];
        $a4 = [];
        $empID  = $jobsArr['employer_id'];
        foreach ($rank as $k => $v) {
            $a4 = [
                    'postjob_id' => $lastJobID,
                    'employer_id' => $empID,
                    'rank_position' => $v,
                    'wages' => $wage[$k],
                    'contract_duration' => $contract_duration[$k],
                    'experience_years' => $experience_years[$k],
                    'experience_months' => $experience_months[$k],
                ];
                array_push($a3, $a4);
        }
        // echo '<pre>';
        // print_r($a3);
        // exit;
        //Insert to wages
        $wageCount = count($a3); 
        for($i=0;$i<$wageCount;$i++){
            DB::table('postjob-wages')->insert($a3[$i]);
            // echo 'INsert record'.$i;
        }
        
        return redirect()->route('postjob.listing')->with('success', 'Post Job successfully created.');
    }
    
    public function postjobUpdate(Request $request,$id)
    {   
        // print_r($request->input('job_description'));
        //  echo "hh<pre>";        
        // print_r($request->input());
        // exit;
        $postjobID = $id;
        $messages = [
            'required' => ':attribute is required.',
            'integer' => ':attribute is must be number.',
            
        ];
        $this->validate($request,[
            'job_title' => 'required|max:255',
            'job_description' => 'required|max:500',
            'postjob_banner' => 'mimes:jpg,jpeg,png,svg|max:2048',
            // 'contract_duration' => 'required|integer|max:12',     
            // 'experience_years' => 'required|integer|min:0',
            // 'experience_months' => 'required|integer|max:12',
            'app_deadline' => 'required|date',
            'vassel_type' => 'required',
            // 'company_name' => 'required',
            // 'email' => 'required|email',
            //  'mobile_no' => 'required|numeric|min:10',
            // 'contact_person' => 'required',
            'address' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'country' => 'required',
            'rank'  => 'required|array|min:1',//'required|array|min:1',
            'wage'  => 'required|array|min:1',
            // 'wage.*'  => 'required|integer',
                ], $messages);
        $postjobArr = $request->input();
        //postjob banner
        $postjobData = Postjob::where('id', $postjobID)->first();

        if($request->hasFile('postjob_banner')){
            $files=$request->file('postjob_banner');
            $path = public_path() . '/postjobBanner/';
            // $profile_file = $request->file('profile_pic')->getClientOriginalName();  //name
            $banner_img = time().'.'.$request->file('postjob_banner')->getClientOriginalExtension();

            // echo 'IMG '.$request->file('profile_pic')->getClientOriginalName();;
            $moved = $files->move($path,$banner_img);
            
            $oldfile = url('/public/postjob_banner/'.$postjobData['postjob_banner']);
            //delete old file
            File::delete($path.$postjobData['postjob_banner']);
            // unset($oldfile);
        }else{
            $banner_img = $postjobData['postjob_banner'];
        }
        

        $empEmail = Session::get('employerEmail');
        
        $employerArr = DB::select("SELECT id FROM employer WHERE email = "."'".$empEmail."'");
        $EmpID =$employerArr[0]->id;
        $emp = [
            'employer_id' => $EmpID,
        ];
        // print_r(count($postjobArr));
       
        //array for wage and rank
        $rank  = $postjobArr['rank'];
        $wage = $postjobArr['wage'];
        $contract_duration = $postjobArr['contract_duration'];
        $experience_years = $postjobArr['experience_years'];
        $experience_months = $postjobArr['experience_months'];
        $employer = DB::table('employer')->where('email', $empEmail)->get();
        // echo $postjobArr['app_deadline'].'<br>';
        foreach ($postjobArr as $k => $v) {
            if($k == 'app_deadline'){    
                $date = $postjobArr['app_deadline'];
                $dateInput = explode('/',$date);
                $deadline = $dateInput[2].'-'.$dateInput[0].'-'.$dateInput[1];
                $postjobArr[$k] = $deadline;
            }
            // $postjobArr[$k] = trim($v);
        }
        
        
        unset($postjobArr['_token']);
        unset($postjobArr['_wysihtml5_mode']);
        unset($postjobArr['rank']);
        unset($postjobArr['wage']);
        unset($postjobArr['contract_duration']);
        unset($postjobArr['experience_years']);
        unset($postjobArr['experience_months']);

        $jobsArr = array_merge($emp, $postjobArr);
        foreach($jobsArr as $k=>$v){

            if($k == 'employer_id' || $k == 'contract_duration' || $k == 'experience_years'|| $k == 'experience_months'|| $k == 'mobile_no' || $k == 'app_deadline'){
                $jobsArr[$k] = $v;
            }else{
               $jobsArr[$k] = trim(strip_tags($v)); 
            }
            $jobsArr['postjob_banner'] = $banner_img;  
        }

         
        //UPDATE to post a job        
        $postjobsUpdate = DB::table('postjob')
            ->where('id', $id)
            ->update($jobsArr);
        // echo '<br>';print_r($lastJobID);
        // exit;
        //post Job wise wages 
        $a3 = [];
        $a4 = [];
        $empID  = $jobsArr['employer_id'];
        foreach ($rank as $k => $v) {
            $a4 = [
                    'postjob_id' => $postjobID,
                    'employer_id' => $empID,
                    'rank_position' => $v,
                    'wages' => $wage[$k],
                    'contract_duration' => $contract_duration[$k],
                    'experience_years' => $experience_years[$k],
                    'experience_months' => $experience_months[$k],
                ];
                array_push($a3, $a4);
        }
         // echo "hh<pre>";        
        // print_r($a3);
        // exit;
        //UPDATE to wages
        $wageCount = count($a3); 
        $deleteOldPost =  DB::table('postjob-wages')->where('postjob_id',$postjobID)->delete();
        if($deleteOldPost){
            for($i=0;$i<$wageCount;$i++){             
                // DB::table('postjob-wages')->insert($a3[$i]);
                $postjobsUpdate = DB::table('postjob-wages')
                ->where('postjob_id', $id)
                ->insert($a3[$i]);
                // echo 'INsert record'.$i;
            }    
        }
                
        return redirect()->route('postjob.listing')->with('success', 'Post Job successfully updated.');
    }
    
    public function deleteJobs($postjobID, $empID){
        // echo 'ID: '.$postjobID.' '.$empID;
        // exit;
        // $d1 = DB::delete('delete from postjob where employer_id = ?'.['employer_id' => $empID]); 
        // $d2 = DB::delete('delete from postjob-wages where employer_id = ?'.['employer_id' => $empID]);
        $d1 = DB::table('postjob')->where('id',$postjobID)->delete();
        $d2 = DB::table('postjob-wages')->where('postjob_id',$postjobID)->delete();
        // dd($d1);
        // var_dump($d2);
        // exit;

        return redirect()->route('postjob.listing')->with('success', 'Post Job deleted successfully.');
    }
    
    //view load companyWiseJob List
    public function companyWiseJoblist(){

        $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                 // ->select( DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount") )
                ->groupBy('postjob-wages.postjob_id')
                // ->orderBy('id','DESC')
                ->where('postjob.postjob_status', 1)                                
                // ->get()
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
                //, DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")        
        // echo '<pre>';
        // print_r($allPostJobLists);
        // exit;
        return view('jobs.joblistCompanyWiseView')->with(['allPostJobLists' => $allPostJobLists]);
        // return view('jobs.joblistCompanyWiseView',compact('allPostJobLists'))->with('i', ($request->input('page', 1) - 1) * 5);
        //with(['joblist' => $joblist, 'empImg' => $emp]);
    }
    
    //filter companyWiseJob List
    public function companyWiseJoblistFilter(Request $request){
        // echo '<pre>';
        // print_r($request->input());

        $city = $request->input('city');        
        $address = explode(",", $request->input('city'));
        if(count($address) == 1){
            $city = $address[0];
        }else{
            $city = $address[count($address)-3];
        } 
        
        // $city = $request->input('city');        
        $company_name = $request->input('company_name');    
        $rank_position = $request->input('rank_position');
        // var_dump(($city !='') && isset($rank_position));
        // echo '<br>cname: '.$company_name.' city: '.$city.' Rank: '.$rank_position;
        // exit;
        if(($company_name != '') && ($city != '') && ($rank_position != '')){

            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->groupBy('postjob-wages.postjob_id')
                ->where('postjob.postjob_status', 1)
                ->where('postjob.city', $city)
                ->where('employer.company_name', $company_name)
                ->where('postjob-wages.rank_position', $rank_position)
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(($company_name != '') && ($city != '')){
            
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)
                ->where('postjob.city', $city)
                ->where('employer.company_name','like','%'.$company_name.'%')                
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(($city !='') && ($rank_position !='')){            
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)
                ->where('postjob.city', $city)
                ->where('postjob-wages.rank_position','like','%'.$rank_position.'%')
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(($company_name != '') && ($rank_position !='')){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)
                ->where('postjob-wages.rank_position', $rank_position)
                ->where('employer.company_name','like','%'.$company_name.'%')                
                // ->get();   
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]); 
        }else if($company_name != ''){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)                
                ->where('employer.company_name','like','%'.$company_name.'%')                
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if($city!= ''){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)                
                ->where('postjob.city','like','%'.$city.'%')
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if($rank_position != ''){
            
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)                
                // ->where('postjob-wages.rank_position','like','%'.$rank_position.'%')
                 ->where('postjob-wages.rank_position' , $rank_position)
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else{
            
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                // ->orderBy('id','DESC')
                ->where('postjob.postjob_status', 1)                                
                // ->get();
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }
        // echo '<pre>';
        // // print_r($request->post());
        // print_r($allPostJobLists);
        // exit;
         return view('jobs.joblistCompanyWiseView',compact('allPostJobLists'));//->with('i', ($request->input('page', 1) - 1) * 5);
        
        // return view('jobs.joblistCompanyWiseView')->with(['allPostJobLists' => $allPostJobLists]);
    }

    //browse job list view job menu 2 load view
    public function browseJoblist(Request $request, $company_name = null, $city = null, $rank_position = null)
    {      
                  
        // echo '<pre>';
        // echo "<pre>";
        // print_r($request->input());
        // // print_r($request->input());
        // exit;
        if(isset(request()->rank)){
            $searchRank = request()->rank;
        }
        
        if(isset(request()->city)){
            $searchByCity = request()->city;
            // echo 'Rank : '.$searchRank.' '.$searchByCity;
        }
        $company_name = request()->segment(4);
        $city = request()->segment(5);
        $rank_position = null;

        if($request->has('homepage')){
            $company_name = $request->input('company_name');
            $rank_position = $request->input('rank_position');

            $address = explode(",", $request->input('city'));
            if(count($address) == 1){
                $city = $address[0];
            }else{
                $city = $address[count($address)-3];
            }                   
        }
        //  echo 'cname: '.$company_name.' city: '.$city.' Rank: '.$rank_position;
        // var_dump(($company_name != '') && ($city != '') && ($rank_position != ''));
        // exit;
        $candiEmail = Session::get('userEmail');
        if(isset($candiEmail)){
            $candidateData = DB::select("SELECT id FROM candidates WHERE email = "."'".$candiEmail."'");
            $jobappliedList = DB::select("SELECT * FROM jobs_apply WHERE candidate_id = "."'".$candidateData[0]->id."'");    
        }        
        // var_dump(isset($rank_position));
        // exit;
        if(($company_name != '') && ($city != '') && ($rank_position != '')){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')                
                ->groupBy('postjob-wages.postjob_id')                
                ->where('postjob.postjob_status', 1)
                ->orwhere('postjob.city','LIKE', "% '".$city."' %")
                ->orwhere('postjob-wages.rank_position','LIKE', "%".$rank_position."%")
                ->orwhere('employer.company_name','LIKE', "%".$company_name."%")                
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(($company_name != '') && ($city != '')){

            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')                
                ->groupBy('postjob-wages.postjob_id')                
                ->where('postjob.postjob_status', 1)                                
                ->where('employer.company_name', $company_name)
                ->where('postjob.city', $city)
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);    
        }else if(($city != '') && ($rank_position != '')){
            
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')                
                ->groupBy('postjob-wages.postjob_id')                
                ->where('postjob.postjob_status', 1)
                ->where('postjob.city', $city)
                ->where('postjob-wages.rank_position', $rank_position)
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);    
        }else if(($rank_position != '') && ($company_name != '')){

            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')                
                ->groupBy('postjob-wages.postjob_id')                
                ->where('postjob.postjob_status', 1)
                ->where('employer.company_name', $company_name)
                ->where('postjob-wages.rank_position', $rank_position)
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(($company_name != '')){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')                
                ->groupBy('postjob-wages.postjob_id')                
                ->where('postjob.postjob_status', 1)                                
                ->where('employer.company_name', $company_name)
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);    
        }else if($city != ''){            
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')                
                ->groupBy('postjob-wages.postjob_id')                
                ->where('postjob.postjob_status', 1)                
                ->where('postjob.city', $city)
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);    
        }else if($rank_position != ''){  
            // echo 'qry';
            // exit;      
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')                
                ->groupBy('postjob-wages.postjob_id')                
                ->where('postjob.postjob_status', 1)                
                ->where('postjob-wages.rank_position', $rank_position)
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);    
        }else{
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')                
                ->where('postjob.postjob_status', 1)                
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);   
        }

        // echo "<pre>";
        // print_r($allPostJobLists);        
        // exit;
        $ranksWithCount =  DB::table('postjob')
                // ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                // ->groupBy('postjob-wages.postjob_id')
                ->groupBy('postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)                
                ->paginate(5,['postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);

        // $expWisePostjob = DB::table('postjob')
        //         // ->join('employer','employer.id','=','postjob.employer_id')
        //         ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')            
        //         ->groupBy('postjob-wages.experience_years')
        //         ->where('postjob.postjob_status', 1)                
        //         ->paginate(5,['postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as expYearCount")]); 


        $locationWisehPostjob =  DB::table('postjob')
                // ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                // ->groupBy('postjob-wages.postjob_id')
                ->groupBy('postjob.city')
                ->where('postjob.postjob_status', 1)
                ->paginate(5,['postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob`.`city`) as citycount")]);   

        // echo "<pre>";
        // print_r($expWisePostjob);
        // // print_r($jobappliedList);
        // exit;

        return view('jobs.browseJoblistView')->with([
            'allPostJobLists' => $allPostJobLists, 
            'ranksWithCount' => $ranksWithCount,
            'locationWisehPostjob' => $locationWisehPostjob
        ]);
    }

    //serch filter homeoage 
    public function browseJoblistFromHome(Request $request, $company_name = null, $city = null, $rank_position = null){
        // echo "<pre>";
        echo 'filter';
        // print_r($request->input());
        // // print_r($request->input());
        // exit;
        if($request->has('homepage')){
            $company_name = $request->input('company_name');
            $rank_position = $request->input('rank_position');

            $address = explode(",", $request->input('city'));
            if(count($address) == 1){
                $city = $address[0];
            }else{
                $city = $address[count($address)-3];
            }                   
        }
    }
    //browse Rank filter
    public function browseJoblistRankfilter(Request $request, $company_name = null, $city = null, $rank_position = null){
        //$result = json_decode($rankSearchList);
        // ini_set('memory_limit', '1024M');
        echo "<pre>";
        print_r($request->input());
        // print_r($request->input());
        exit;
        if($request->has('homepage')){
            $company_name = $request->input('company_name');
            $rank_position = $request->input('rank_position');

            $address = explode(",", $request->input('city'));
            if(count($address) == 1){
                $city = $address[0];
            }else{
                $city = $address[count($address)-3];
            }                   
        }
        

       if(isset($company_name) && isset($city) && isset($rank_position)){            
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->groupBy('postjob-wages.postjob_id')
                ->where('postjob.postjob_status', 1)
                ->where('postjob.city', $city)
                ->where('employer.company_name', $company_name)
                ->where('postjob-wages.rank_position', $rank_position)
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(isset($company_name) && isset($city)){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)
                ->where('postjob.city', $city)
                ->where('employer.company_name','like','%'.$company_name.'%')                
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(isset($city) && isset($rank_position)){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)
                ->where('postjob.city', $city)
                ->where('postjob-wages.rank_position','like','%'.$rank_position.'%')
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(isset($company_name) && isset($rank_position)){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)
                ->where('postjob-wages.rank_position', $rank_position)
                ->where('employer.company_name','like','%'.$company_name.'%')                
                // ->get();   
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]); 
        }else if(isset($company_name)){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)                
                ->where('employer.company_name','like','%'.$company_name.'%')                
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(isset($city)){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)                
                ->where('postjob.city','like','%'.$city.'%')
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else if(isset($rank_position)){
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                ->where('postjob.postjob_status', 1)                
                ->where('postjob-wages.rank_position','like','%'.$rank_position.'%')
                // ->get();    
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }else{
            $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                // ->select('employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position')
                // ->orderBy('id','DESC')
                ->where('postjob.postjob_status', 1)                                
                // ->get();
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.rank_position', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);
        }
        /*
        $rankList = $request->post('rankSearchList');
       
        $query = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')->where('postjob.postjob_status', 1);
        foreach ($rankList as $rank) {
           $query->Where('postjob-wages.rank_position', '=', $rank);
        }
        $query->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]); 

        // $allPostJobLists = $query;
        // echo '<pre>';
        // print_r($allPostJobLists);
        // exit;
        // for($i=0;$i<coou){
        //     $where =             
        // }
        

        // $paging = 
        $allPostJobLists = DB::table('postjob')
                ->join('employer','employer.id','=','postjob.employer_id')
                ->join('postjob-wages','postjob-wages.postjob_id','=','postjob.id')
                ->groupBy('postjob-wages.postjob_id')
                ->where('postjob.postjob_status', 1)
                ->paginate(5,['employer.company_name','employer.company_logo','postjob.*','postjob-wages.id as postwage_id','postjob-wages.rank_position' ,'postjob-wages.wages', DB::raw("count(`postjob-wages`.`postjob_id`) as rankcount")]);  
        echo '<pre>';
        print_r($results);
        exit;
        */
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
        // echo 'post ID '.$id;
        // exit;
        $empEmail = Session::get('employerEmail');
        $empImg = DB::select("SELECT id,pic_path,email_varified,profile_status FROM employer where email="."'".$empEmail."'");
        $empID = $empImg[0]->id;
        $postjobs = DB::select("SELECT * FROM postjob where employer_id="."'".$empID."' and id=".$id);
        $wages = DB::select("SELECT * FROM `postjob-wages` where postjob_id=".$id);
        
        return view('employer.updatePostjob')->with(['empImg' => $empImg, 'postjobs' => $postjobs, 'wages' => $wages]);
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
