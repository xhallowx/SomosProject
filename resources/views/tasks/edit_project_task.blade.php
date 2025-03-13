@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('build/assets/css/tasks/editProjectTask.css')}}">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Edit pending Task for the Project: <p class="name">{{ $projectTask->project->name_project }}</p></h2>
        
        @if(session('success'))
            <div id="alert" class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('project_tasks.update', $projectTask->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Field for project (disable) -->
            <div class="form-group">
                <label for="name_project_display">Project</label>
                <input type="text" class="form-control" id="name_project_display" value="{{ $projectTask->project->name_project }}" disabled>
                <input type="hidden" id="project_id" name="project_id" value="{{ $projectTask->project_id }}">
            </div>

            <!-- Select owner of the pending task -->
            <div class="form-group">
                <label for="owner">Task Owner</label>
                <select class="form-control" id="owner" name="owner" required>
                    <option value="">Select</option>
                    @foreach($users as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Description of the pending task -->
            <div class="form-group">
                <label for="description_task">Task Description</label>
                <textarea class="form-control descripcion" id="description_task" name="description_task" rows="4" required>{{ $projectTask->description_task }}</textarea>
            </div>

            <!-- Date field -->
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $projectTask->start_date }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="finish_date">End Date</label>
                    <input type="date" class="form-control" id="finish_date" name="finish_date" value="{{ $projectTask->finish_date }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="task_date_display">Task Date (Edition)</label>
                    <!-- The current date and time is displayed and editing is blocked -->
                    <?php
                        date_default_timezone_set('America/Bogota');
                        $currentDate = date('Y-m-d\TH:i');
                    ?>
                    <input type="datetime-local" class="form-control" id="task_date_display" value="{{ $currentDate }}" disabled>
                    <input type="hidden" id="task_date" name="task_date" value="{{ $currentDate }}">
                </div>
            </div>

             <!-- Task status field -->
            <div class="form-group">
                <label for="task_state">Task State</label>
                <select class="form-control" id="task_state" name="task_state" required>
                    <option class="option" value="Pending" {{ $projectTask->task_state == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option class="option" value="In Progress" {{ $projectTask->task_state == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option class="option" value="Completed" {{ $projectTask->task_state == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option class="option" value="Blocked" {{ $projectTask->task_state == 'Blocked' ? 'selected' : '' }}>Blocked</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>   
            <a href="{{ route('tasks.observation') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<script src="{{asset('build/assets/js/tasks/editProjectTask.js')}}"></script>
</body>
</html>
@endsection