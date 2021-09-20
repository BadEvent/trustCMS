<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $table = 'task';
    public $timestamps = false;

    public function getTasksDo(int $userId)
    {
        return Task::where([
            ['implementer_id', '=', $userId],
            ['date_end', '=', null],
        ])->get();
    }

    public function getTasksAll()
    {
        return Task::all();
    }

    public function getTaskById(int $id)
    {
        return Task::where('id', '=', $id)->get();
    }

    public function createTask($data)
    {
        self::insert($data);
    }

    public function updateById(int $id, array $data)
    {
        self::where('id', '=', $id)->update($data);
    }

    public function getLast()
    {
        return self::orderBy('id', 'desc')->pluck('id')->first();
    }

}
