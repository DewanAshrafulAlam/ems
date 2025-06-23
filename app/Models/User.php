<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;  // <-- add this if using Sanctum

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;  // <-- add HasApiTokens here

    protected $fillable = ['name', 'email', 'password'];
}

