<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'solution', 
        'check_query', 'er_diagram'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_passed')
            ->withTimestamps();
    }
}
