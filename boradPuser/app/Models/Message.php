<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
}
