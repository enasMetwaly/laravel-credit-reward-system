<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $guarded = [];
      protected $fillable = [
        'name',
        'email',
        'password',
    ];
}