<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use  HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_penyewa', 
        'email', 
        'password', 
        'role',
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
