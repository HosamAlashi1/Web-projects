<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable 
{
    // Notifiable  >> this for notifications
    use HasFactory,Notifiable;  
    protected $fillable = ['name','photo','email','password','created_at','updated_at'];
    protected $hidden = ['password','remember_token'];
}
