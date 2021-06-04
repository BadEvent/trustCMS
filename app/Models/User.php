<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'users';

    public function createUser($userData)
    {
        User::insert($userData);
//        return true;
    }

    public function validationLoginUser($login)
    {
        return User::where('login', '=', $login)->count();
    }

    public function validationEmailUser($email)
    {
        return User::where('email', '=', $email)->count();
    }


}
