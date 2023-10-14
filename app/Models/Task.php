<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';

    use HasFactory;

    protected $fillable = ['title', 'description', 'duedate', 'user_email', 'days', 'status', 'priority'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }
}

