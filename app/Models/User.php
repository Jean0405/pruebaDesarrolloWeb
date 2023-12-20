<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = [
        'identification_number',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'location',
        'password',
        'type',
        'first_login',
    ];
    protected $primaryKey = 'identification_number';

    protected $hidden = [
        'password'
    ];
}
