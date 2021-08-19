<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'organization';

    public static function getAddressByName(string $name)
    {
        return Organization::where('name', '=', $name)->pluck('address');
    }
}
