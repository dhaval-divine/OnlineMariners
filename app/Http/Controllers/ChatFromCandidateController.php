<?php

namespace App\Http\Controllers;

use App\Message;
use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatFromCandidateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get();

        // count how many message are unread from the selected user
        // $users = DB::select("select users.id, users.name, users.avatar, users.email, count(is_read) as unread 
        // from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        // where users.id != " . Auth::id() . " 
        // group by users.id, users.name, users.avatar, users.email");
        $candidateEmail = Session::get('userEmail');
        
        $candidate = DB::select("select id from candidates where email ='".$candidateEmail."'"); 
        // echo '<pre>';
        // print_r($candidate);
        // exit;
        if($candidate){
            // $users = DB::select("SELECT e.name AS EmployerName,e.pic_path,e.email,e.login_status,c.name as CandidateName,m.* FROM jobs_apply ja inner join messages m on m.from=ja.employer_id and m.to=ja.candidate_id
            //     inner join employer e on e.id = m.from inner join candidates c on c.id = m.to 
            //     where m.from=".$candidate[0]->id." OR m.to = ".$candidate[0]->id);

            $users = DB::table('jobs_apply')
                ->join('employer','employer.id','=','jobs_apply.employer_id')
                ->join('postjob','employer.id','=','postjob.employer_id')
                ->join('candidates','candidates.id','=','jobs_apply.candidate_id')
                ->select('employer.id','employer.name as employer_name','candidates.name as candidates_name','employer.pic_path','employer.email','employer.login_status')->where('jobs_apply.candidate_id', $candidate[0]->id)
                ->groupBy('jobs_apply.employer_id')
                // ->where('postjob.postjob_status', 1)
                ->get();
            // $users = DB::select("select employer.id, employer.name, employer.pic_path, employer.email,employer.login_status, count(is_read) as unread from employer LEFT  JOIN  messages ON employer.id = messages.from and is_read = 0 and messages.to = " . $candidate[0]->id. " where employer.id != " . $candidate[0]->id . "  group by employer.id, employer.name, employer.pic_path, employer.email");   
            // echo "<pre>";    
            // print_r($users);
            // exit;
            //And candidates.login_status = 1
        }else{
            $users = [];
            echo "<script>alert('Please Login first.')</script>";
        }
        
        // $login =1;
        // $users = DB::select("select id,name,email,profile_path from candidates where login_status = ".$login); 
        

        return view('chatFromCandidare', ['users' => $users]);
    }

    public function getMessage($user_id)
    {   
        $candidate = Session::get('userEmail');
        $candidate = DB::select("select id from candidates where email ='".$candidate."'"); 
                
        $my_id = $candidate[0]->id;//Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('messages.indexChatFromCandidate', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $candidate = Session::get('userEmail');
        $candidate = DB::select("select id from candidates where email ='".$candidate."'"); 
        
        $receiverid = $request->post('receiver_id');
        // exit;
        if($candidate[0]->id){
            $from = $candidate[0]->id;    
        }else{
            $from = '';
            echo "<script>alert('Employer is not online.')</script>";
        }
        
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        if($candidate[0]->id){
            $my_id = $candidate[0]->id;    
        }else{
            echo "<script>alert('Employer has not login yet')</script>";
        }
        

        Message::where(['from' => $receiverid, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($receiverid, $my_id) {
            $query->where('from', $receiverid)->where('to', $my_id);
        })->oRwhere(function ($query) use ($receiverid, $my_id) {
            $query->where('from', $my_id)->where('to', $receiverid);
        })->get();

        return view('messages.indexChatFromCandidate', ['messages' => $messages]);
        
        /* pusher */

        // $options = array(
        //     'cluster' => 'ap2',
        //     'useTLS' => true
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        // $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter

        // $pusher->trigger('my-channel', 'my-event', $data);
    }
}
