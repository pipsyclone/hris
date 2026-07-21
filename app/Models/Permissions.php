<?php

namespace App\Models;

class Permissions extends BaseModel
{
    protected $table = 'permissions';
    protected $fillable = [
        'name',
    ];
}
