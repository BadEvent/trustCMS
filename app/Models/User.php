<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $table = 'users';


    public function create(array $data): bool
    {
        $user = self::where('login', '=', $data['login'])
            ->orWhere('email', '=', $data['email'])
            ->first();

        if ($user == null) {
            self::insert($data);

            return true;
        }

        return false;
    }

    public function auth($data)
    {
        return self::where(
            [
                ['login', '=', $data['username']],
                ['password', '=', md5($data['password'])],
            ]
        )->select(['id', 'login', 'email', 'first_name', 'second_name'])
            ->first();
    }

    public static function getByIdStatic(int $id)
    {
        return self::where('id', '=', $id)->first();
    }
}
