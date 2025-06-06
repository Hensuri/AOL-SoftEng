<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'post_id',
        'question_text',
        'correct_answer',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
