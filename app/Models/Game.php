<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'post_id',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
