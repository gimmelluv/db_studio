<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['theory_id', 'title', 'description', 'min_score'];
    
    public function theory()
    {
        return $this->belongsTo(Theory::class);
    }
    
    public function questions()
    {
        return $this->hasMany(TestQuestion::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('score', 'is_passed');
    }
}
