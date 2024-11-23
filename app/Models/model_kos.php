<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class model_kos extends Authenticatable
{
    use HasFactory, Notifiable;
    // public $table = "user";
    protected $table = "user";
    protected $primaryKey = 'username';
    public $fillable = ['username', 'password', 'first_name', 'last_name', 'email'];

}
