<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_project',
        'owner',
        'request_area',
        'priority',
        'request_date',
        'start_date',
        'finish_date',
        'project_description',
        'project_state'
    ];

    // Relación con las tareas pendientes asignadas al proyecto
    public function projectTasks()
    {
        return $this->hasMany(ProjectTask::class, 'project_id');
    }
}
