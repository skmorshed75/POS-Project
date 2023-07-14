<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
// use League\CommonMark\Extension\Attributes\Node\Attributes;

class User extends Authenticatable
{
    protected $fillable = [
        'firstName','lastName','email','mobile','password','otp'
    ];
 
    protected $attributes = [
        'otp' => '0'
    ];

}
