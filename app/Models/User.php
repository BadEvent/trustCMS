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
    }

    public function validationLoginUser($login)
    {
        return User::where('login', '=', $login)->count();
    }

    public function getUserById(int $id = null)
    {
        return User::where('id', '=', $id)->first();
    }

    public function getLoginById(int $id = null)
    {
        return User::where('id', '=', $id)->select(['login'])->first();
    }

    public function validationEmailUser($email)
    {
        return User::where('email', '=', $email)->count();
    }

    public function authUser($data)
    {
        return User::where(
            [
                ['login', '=', $data['login']],
                ['password', '=', md5($data['password'])],
            ]
        )->get();
    }


}
