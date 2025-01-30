<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tarea', compact('tasks'));
    }

    public function create()
    {
        $tasks = Task::all();
        return view('tasks.create', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_project' => 'required',
            'owner' => 'required',
            'request_area' => 'required',
            'priority' => 'required',
            'request_date' => 'required|date',
            'start_date' => 'required|date',
            'finish_date' => 'required|date|after_or_equal:start_date',
            'project_description' => 'required',
            'project_state' => 'required'
        ]);
    
        Task::create($request->all());
    
        return redirect()->route('tasks.create')->with('success', 'Tarea guardada con éxito!');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_project' => 'required',
            'owner' => 'required',
            'request_area' => 'required',
            'priority' => 'required',
            'request_date' => 'required|date',
            'start_date' => 'required|date',
            'finish_date' => 'required|date|after_or_equal:start_date',
            'project_description' => 'required',
            'project_state' => 'required'
        ]);
    
        $task = Task::findOrFail($id);
        $task->update($request->all());
    
        return redirect()->route('tasks.create')->with('success', 'Tarea actualizada con éxito!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.create')->with('success', 'Tarea eliminada con éxito!');
    }

    public function filterByOwner($owner)
    {
        $tasks = Task::where('owner', $owner)->get();
        return response()->json($tasks);
    }
}
