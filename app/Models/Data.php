<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function createData($userDataFull)
    {
        self::insert($userDataFull);
    }

    public function getLastData()
    {
        return self::latest('id')->limit(1)->get();
    }

    public function getDataById(int $id)
    {
        return self::where('id', '=', $id)->get();
    }

    public function getDataName(int $id)
    {
        return self::where('id', '=', $id)->select(['first_name', 'second_name'])->first();
    }

    public static function getDataNameStatic(int $id)
    {
        return self::where('id', '=', $id)->select(['first_name', 'second_name'])->first();
    }

    public function user_data()
    {
       return $this->hasOne(User::class);
    }
}
