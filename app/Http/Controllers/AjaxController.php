<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AjaxController extends Controller
{
    
    public function getPosthJobID(Request $request)
    {
    	
    	$postjob_id = $request->post('postjob_id');
    	$employer_id = $request->post('employer_id');
    	$rank = $request->post('rank');
    	$postjobs = DB::select("SELECT id FROM `postjob-wages` where postjob_id="."'".$postjob_id."' and employer_id=".$employer_id." and rank_position='".$rank."'");
    	//wageid
    	echo $postjobs[0]->id;
    }
}
