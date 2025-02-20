<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    /** @use HasFactory<\Database\Factories\TheoryFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
    ];
}
