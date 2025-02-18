<?php

namespace App\Http\Controllers;

use App\Models\Task;          // Modelo de proyectos
use App\Models\ProjectTask;   // Modelo de tareas asignadas a proyectos
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    // Muestra el formulario para asignar una tarea pendiente a un proyecto
    public function create(Request $request)
    {
        // Se espera recibir el id del proyecto por query string, por ejemplo: ?project_id=5
        $project_id = $request->query('project_id');
        $project = Task::findOrFail($project_id);
        return view('tasks.create_project_task', compact('project'));
    }

    // Almacena la tarea pendiente para el proyecto
    public function store(Request $request)
    {
        $request->validate([
            'project_id'       => 'required|exists:tasks,id',
            'owner'            => 'required',
            'description_task' => 'required',
            'start_date'       => 'required|date',
            'finish_date'      => 'required|date|after_or_equal:start_date',
            'task_date'        => 'nullable|date',
            'task_state'       => 'required|in:Pending,In Progress,Completed'
        ]);

        $taskDate = $request->task_date ? str_replace('T', ' ', $request->task_date) : now();
    
        ProjectTask::create([
            'project_id'       => $request->project_id,
            'owner'            => $request->owner,
            'description_task' => $request->description_task,
            'start_date'       => $request->start_date,
            'finish_date'      => $request->finish_date,
            'task_date'        => $taskDate,
            'task_state'       => $request->task_state
        ]);

        return redirect()->route('tasks.observation', ['project_id' => $request->project_id])
                         ->with('success', 'Tarea asignada al proyecto correctamente.');
    }

    // Muestra el formulario para editar una tarea pendiente
    public function edit($id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        return view('tasks.edit_project_task', compact('projectTask'));
    }

    // Actualiza la tarea pendiente
    public function update(Request $request, $id)
    {
        $request->validate([
            'owner'            => 'required',
            'description_task' => 'required',
            'start_date'       => 'required|date',
            'finish_date'      => 'required|date|after_or_equal:start_date',
            'task_date'        => 'nullable|date',
            'task_state'       => 'required|in:Pending,In Progress,Completed'
        ]);
    
        $projectTask = ProjectTask::findOrFail($id);

        $taskDate = $request->task_date ? str_replace('T', ' ', $request->task_date) : now();

        $projectTask->update([
            'owner'            => $request->owner,
            'description_task' => $request->description_task,
            'start_date'       => $request->start_date,
            'finish_date'      => $request->finish_date,
            'task_date'        => $taskDate,
            'task_state'       => $request->task_state
        ]);

        return redirect()->route('tasks.observation')->with('success', 'Tarea del proyecto actualizada correctamente.');
    }

    // Elimina la tarea pendiente
    public function destroy($id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        $projectTask->delete();

        return redirect()->route('tasks.observation')->with('success', 'Tarea del proyecto eliminada correctamente.');
    }

    // Muestra la vista de observación: todos los proyectos con sus tareas asignadas
    public function observation(Request $request)
    {
        $ownerFilter = $request->query('owner');
        $projectFilter = $request->query('project');

        // Construir la consulta para filtrar según los parámetros
        $query = Task::with('projectTasks');

        if ($ownerFilter && $ownerFilter !== 'Seleccionar') {
            $query->where('owner', $ownerFilter);
        }

        if ($projectFilter && $projectFilter !== 'Seleccionar') {
            $query->where('name_project', $projectFilter);
        }

        $projects = $query->get();

        // Obtener listas de owners y nombres de proyectos para el formulario de búsqueda
        $owners = Task::select('owner')->distinct()->pluck('owner');
        $projectNames = Task::select('name_project')->distinct()->pluck('name_project');

        return view('tasks.observation', compact('projects', 'owners', 'projectNames'));
    }
}
