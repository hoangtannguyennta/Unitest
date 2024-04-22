<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Roles extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'user_id',
    ];
}
