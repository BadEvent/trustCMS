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
}
