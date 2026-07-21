<?php

namespace App\Models;

class JobCandidate extends BaseModel
{
    protected $table = 'job_candidates';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'resume',
        'position',
        'status',
    ];

    public function position()
    {
        return $this->belongsTo(JobPosition::class, 'position');
    }
}
