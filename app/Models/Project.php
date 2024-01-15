<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    // Регистрируем событие на soft delete
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($project) {
            // Вызываем soft delete для связанных задач
            $project->tasks()->delete();
        });
    }
}
