<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createPages($data)
    {
        self::insert($data);
    }

    public function getPages()
    {
        return self::all();
    }

    public function getById(int $id)
    {
        return self::where('id', '=', $id)->first();
    }

    public function updatePages(array $data)
    {
        try {
            self::where('id', '=', $data['id'])->update($data);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getByLink($link)
    {
        return self::where('link', '=', $link)->first();
    }
}
