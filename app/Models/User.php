<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function theories(): BelongsToMany
    // {
    //     return $this->belongsToMany(Theory::class)->withPivot('is_passed');
    // }

    public function theories()
    {
        return $this->belongsToMany(Theory::class)
            ->withPivot('is_passed')
            ->withTimestamps();
    }
    
    public function tests()
    {
        return $this->belongsToMany(Test::class)
            ->withPivot('score', 'is_passed')
            ->withTimestamps();
    }
    /**
     * Получить диаграммы пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diagrams(): HasMany
    {
        return $this->hasMany(Diagram::class);
    }

        // app/Models/User.php
    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('is_passed');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}
