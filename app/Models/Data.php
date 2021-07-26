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
        Data::insert($userDataFull);
    }

    public function getLastData()
    {
        return Data::latest('id')->limit(1)->get();
    }

    public function getDataById(int $id)
    {
        return Data::where('id', '=', $id)->get();
    }

    public function getDataName(int $id)
    {
        return Data::where('id', '=', $id)->select(['first_name'])->first();
    }
}
