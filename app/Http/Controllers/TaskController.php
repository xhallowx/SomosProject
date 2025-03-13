<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\OccupancyController;

class TaskController extends Controller
{
    // Shows the project listing view (project creation)
    public function create()
    {
        // All created projects are obtained
        $users = User::all();
        $tasks = Task::all();
        return view('tasks.create', compact('tasks', 'users'));
    }

    // Stores a new project (task in the sense of project)
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

        $owner = $request->owner;
        $occupancyData = OccupancyController::getOwnerOccupancy($owner);

        if ($occupancyData['occupancy'] >= 100) {
            return redirect()->route('summary')
                             ->with('error', "$owner it already has 100% occupancy.");
        }

        Task::create($request->all());

        return redirect()->route('tasks.create')
                        ->with('success', 'Project created successfully!');
    }

    // Shows the view to edit a project
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    // Update a project
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
    
        return redirect()->route('tasks.create')->with('success', 'Project edited successfully!');
    }

    // Delete a project
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.create')->with('success', 'Project deleted successfully!');
    }

    // Search functions in the "task.blade.php" view
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
