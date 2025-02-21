<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Diagram extends Model
{
    protected $fillable = ['type', 'title', 'description', 'file_path'];

    // Добавляем слушатель события deleting
    protected static function boot()
    {
        parent::boot();

        // Перед удалением записи из БД
        static::deleting(function ($diagram) {
            // Удаляем файл
            if ($diagram->file_path) {
                Storage::disk('public')->delete($diagram->file_path);
            }
        });
    }
}
