<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $fillable = ['test_id', 'question', 'options', 'correct_answer', 'score'];
    
    protected $casts = [
        'options' => 'array'
    ];
    
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
