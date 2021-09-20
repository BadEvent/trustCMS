<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'organization';

    public function createData($organization)
    {
        self::insert($organization);
    }

    public function getLastData()
    {
        return self::latest('id')->first();
    }

    public function getById(int $id)
    {
        return self::where('id', '=', $id)->first();
    }

    public static function getAddressByName(string $name)
    {
        return self::where('name', '=', $name)
            ->groupBy('address')
            ->pluck('address');
    }

    public function getForRegistration($params)
    {
        return self::where([
            ['name', '=', $params['name']],
            ['address', '=', $params['address']],
            ['housing', '=', $params['housing']],
            ['office', '=', $params['office']]
        ])->first();
    }

    public static function getHousingByName(string $name)
    {
        return self::where('name', '=', $name)
            ->groupBy('housing')
            ->pluck('housing');
    }

    public static function getHousingByNameByAddress(string $name, string $address)
    {
        return self::where([['name', '=', $name], ['address', '=', $address]])
            ->groupBy('housing')
            ->pluck('housing');
    }

    public static function getOfficeByNameByHousing(string $name, string $housing)
    {
        return self::where([['name', '=', $name], ['housing', '=', $housing]])
            ->groupBy('office')
            ->pluck('office');
    }
}
