<?php

namespace App\Models;

class JobPosition extends BaseModel
{
    protected $table = 'job_positions';
    protected $fillable = [
        'name',
    ];
}
