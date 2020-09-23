<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    protected $table = 'jobs_apply';

    protected $fillable = [
         'candidate_id','employer_id', 'postjob_id', 'postwage_id','rank_position','apply_status',
    ];
}
