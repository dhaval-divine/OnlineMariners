<?php

namespace App\Http\Controllers;

use App\Message;
use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatController extends Controller
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
        $emp = Session::get('employerEmail');
        $employer = DB::select("select id from employer where email ='".$emp."'"); 
        // echo '<pre>';
        // print_r($employer);
        // exit;
        if($employer){
            // $users = DB::select("select candidates.id, candidates.name, candidates.profile_path, candidates.email,candidates.login_status, count(is_read) as unread from candidates LEFT  JOIN  messages ON candidates.id = messages.from and is_read = 0 and messages.to = " . $employer[0]->id. " where candidates.id != " . $employer[0]->id . "  group by candidates.id, candidates.name, candidates.profile_path, candidates.email"); 
            $users = DB::table('jobs_apply')
                ->join('employer','employer.id','=','jobs_apply.employer_id')                
                ->join('postjob','employer.id','=','postjob.employer_id')
                ->join('candidates','candidates.id','=','jobs_apply.candidate_id')
                ->select('candidates.id','candidates.email','candidates.name as candidate_name','candidates.profile_path','employer.name as employer_name', 'candidates.login_status')
                ->where('jobs_apply.employer_id', $employer[0]->id)
                ->groupBy('jobs_apply.candidate_id')
                ->get();

            // echo "<pre>";    
            // print_r($users);
            // exit;
            //And candidates.login_status = 1
        }else{
            $users = [];
            echo "<script>alert('Employer is not login yet.')</script>";
        }
        
        // $login =1;
        // $users = DB::select("select id,name,email,profile_path from candidates where login_status = ".$login); 
        

        return view('chat', ['users' => $users]);
    }

    public function getMessage($user_id)
    {   
        $emp = Session::get('employerEmail');
        $employer = DB::select("select id from employer where email ='".$emp."'"); 
                
        $my_id = $employer[0]->id;//Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $emp = Session::get('employerEmail');
        $employer = DB::select("select id from employer where email ='".$emp."'"); 
        
        $receiverid = $request->post('receiver_id');
        // exit;
        if($employer[0]->id){
            $from = $employer[0]->id;    
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
        
        if($employer[0]->id){
            $my_id = $employer[0]->id;    
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

        return view('messages.index', ['messages' => $messages]);
        
        /* pusher */
        /*
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter

        $pusher->trigger('my-channel', 'my-event', $data);
        */
    }
}
