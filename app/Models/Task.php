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
        return Task::where('implementer_id', '=', $userId)->get();
    }
}
