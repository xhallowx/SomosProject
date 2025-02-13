<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'owner',
        'description_task',
        'start_date',
        'finish_date',
        'task_date',
        'task_state'
    ];

    protected $casts = [
        'task_date' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Task::class, 'project_id');
    }
}
