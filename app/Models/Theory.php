<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Theory extends Model
{
    /** @use HasFactory<\Database\Factories\TheoryFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('is_passed');
    }

    public function test()
    {
        return $this->hasOne(Test::class); // Или hasMany, если у вас несколько тестов
    }
}
