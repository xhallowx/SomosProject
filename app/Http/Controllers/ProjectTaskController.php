<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;          // Project model
use App\Models\ProjectTask;   // Model of tasks assigned to projects
use Illuminate\Http\Request;
use App\Http\Controllers\OccupancyController;

class ProjectTaskController extends Controller
{
    // Shows the form to assign a pending task to a project
    public function create(Request $request)
    {
        // It is expected to receive the project id by query string, for example: ?project_id=5
        $users = User::all();
        $project_id = $request->query('project_id');
        $project = Task::findOrFail($project_id);
        return view('tasks.create_project_task', compact('project', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'       => 'required|exists:tasks,id',
            'owner'            => 'required',
            'description_task' => 'required',
            'start_date'       => 'required|date',
            'finish_date'      => 'required|date|after_or_equal:start_date',
            'task_date'        => 'nullable|date',
            'task_state'       => 'required|in:Pending,In Progress,Completed,Blocked'
        ]);

        $owner = $request->owner;
        $occupancyData = OccupancyController::getOwnerOccupancy($owner);

        if ($occupancyData['occupancy'] >= 100) {
            return redirect()->route('summary')
                            ->with('error', "$owner it already has 100% occupancy.");
        }

        ProjectTask::create($request->all());

        return redirect()->route('tasks.observation', ['project_id' => $request->project_id])
                        ->with('success', 'Task assigned to the project correctly!');
    }

    // Shows the form to edit a pending task
    public function edit($id)
    {
        $users = User::all();
        $projectTask = ProjectTask::findOrFail($id);
        return view('tasks.edit_project_task', compact('projectTask', 'users'));
    }

    // Update pending task
    public function update(Request $request, $id)
    {
        $request->validate([
            'owner'            => 'required',
            'description_task' => 'required',
            'start_date'       => 'required|date',
            'finish_date'      => 'required|date|after_or_equal:start_date',
            'task_date'        => 'nullable|date',
            'task_state'       => 'required|in:Pending,In Progress,Completed,Blocked'
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

        return redirect()->route('tasks.observation')->with('success', 'Project Task updated successfully!');
    }

    // Delete the pending task
    public function destroy($id)
    {
        $projectTask = ProjectTask::findOrFail($id);
        $projectTask->delete();

        return redirect()->route('tasks.observation')->with('success', 'Project Task successfully deleted!');
    }

    // Shows the observation view: all projects with their assigned tasks
    public function observation(Request $request)
    {
        $ownerFilter = $request->query('owner');
        $projectFilter = $request->query('project');

        // Build the query to filter based on parameters
        $query = Task::with('projectTasks');

        if ($ownerFilter && $ownerFilter !== 'Seleccionar') {
            $query->where('owner', $ownerFilter);
        }

        if ($projectFilter && $projectFilter !== 'Seleccionar') {
            $query->where('name_project', $projectFilter);
        }

        $projects = $query->get();

        // Get lists of owners and project names for the search form
        $owners = Task::select('owner')->distinct()->pluck('owner');
        $projectNames = Task::select('name_project')->distinct()->pluck('name_project');

        return view('tasks.observation', compact('projects', 'owners', 'projectNames'));
    }
}
