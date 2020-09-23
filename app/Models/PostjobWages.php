<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostjobWages extends Model
{
    protected $table = 'postjob-wages';

    protected $fillable = [
        'name', 'employer_id', 'rank_position', 'wages',
    ];
}
