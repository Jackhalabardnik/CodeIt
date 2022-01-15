<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    public function task() {
        return $this->hasOne(Task::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }
}
