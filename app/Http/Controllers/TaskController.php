<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Muestra la vista de listado de proyectos (creación de proyectos)
    public function create()
    {
        // Se obtienen todos los proyectos creados
        $tasks = Task::all();
        return view('tasks.create', compact('tasks'));
    }

    // Almacena un nuevo proyecto (tarea en el sentido de proyecto)
    public function store(Request $request)
    {
        $request->validate([
            'name_project'        => 'required',
            'owner'               => 'required',
            'request_area'        => 'required',
            'priority'            => 'required|in:Low,Medium,High',
            'request_date'        => 'required|date',
            'start_date'          => 'required|date',
            'finish_date'         => 'required|date|after_or_equal:start_date',
            'project_description' => 'required',
            'project_state'       => 'required'
        ]);
    
        try {
            Task::create($request->all());
            return redirect()->route('tasks.create')->with('success', 'Proyecto creado con éxito!');
        } catch (\Exception $e) {
            return redirect()->route('tasks.create')->with('error', 'Hubo un problema al crear el proyecto: ' . $e->getMessage());
        }
    }

    // Muestra la vista para editar un proyecto
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // Actualiza un proyecto
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_project'        => 'required',
            'owner'               => 'required',
            'request_area'        => 'required',
            'priority'            => 'required|in:Low,Medium,High',
            'request_date'        => 'required|date',
            'start_date'          => 'required|date',
            'finish_date'         => 'required|date|after_or_equal:start_date',
            'project_description' => 'required',
            'project_state'       => 'required'
        ]);
    
        $task = Task::findOrFail($id);
        $task->update($request->all());
    
        return redirect()->route('tasks.create')->with('success', 'Proyecto editado con éxito!');
    }

    // Elimina un proyecto
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.create')->with('success', 'Proyecto eliminado con éxito!');
    }

    // Funciones de búsqueda en la vista "tarea.blade.php"
    public function showSearchForm()
    {
        $owners = Task::distinct()->pluck('owner');
        $projects = Task::distinct()->pluck('name_project');
        return view('tasks.tarea', compact('owners', 'projects'));
    }

    public function searchTasks(Request $request)
    {
        $query = Task::query();

        if ($request->has('owner') && !empty($request->owner)) {
            $query->where('owner', $request->owner);
        }

        if ($request->has('project') && !empty($request->project)) {
            $query->where('name_project', $request->project);
        }

        return response()->json($query->get());
    }
}
