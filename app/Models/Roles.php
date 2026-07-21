<?php

namespace App\Models;

class Roles extends BaseModel
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'slug',
    ];
}
