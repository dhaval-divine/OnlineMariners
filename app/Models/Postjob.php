<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postjob extends Model
{
    protected $table = 'postjob';

    protected $fillable = [
        'employer_id', 'job_title', 'job_description','contract_duration','experience_years',
        'experience_months','app_deadline','vassel_type','company_name','email',
        'contact_person','mobile_no','address','city','state','country',
    ];
}
