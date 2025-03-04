@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('build/assets/css/tasks/taskProject.css')}}">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Assign Pending Task to the Project: <p class="name">{{ $project->name_project }}</p></h2>
        
        @if(session('success'))
            <div id="alert" class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('project_tasks.store') }}" method="POST" class="confirm-form">
            @csrf
            <!-- Field for project (disabled) -->
            <div class="form-group">
                <label for="name_project_display">Project</label>
                <input type="text" class="form-control" id="name_project_display" value="{{ $project->name_project }}" disabled>
                <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}">
            </div>

            <!-- Select the owner of the pending task -->
            <div class="form-group">
                <label for="owner">Task Owner</label>
                <select class="form-control" id="owner" name="owner" required>
                    <option value="">Select</option>
                    @foreach(['Sebastian', 'Samir', 'Diego', 'Edwin', 'Bryan', 'Erick'] as $owner)
                        <option value="{{ $owner }}">{{ $owner }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Description of the pending task -->
            <div class="form-group">
                <label for="description_task">Task Description</label>
                <textarea class="form-control descripcion" id="description_task" name="description_task" rows="4" required></textarea>
            </div>

            <!-- Date fields -->
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="finish_date">End Date</label>
                    <input type="date" class="form-control" id="finish_date" name="finish_date" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="task_date_display">Task Date (Created)</label>
                    <!-- The current date and time is displayed and editing is blocked -->
                    <?php
                    // Set the time zone to Colombia before displaying the date
                        date_default_timezone_set('America/Bogota');
                        $currentDate = date('Y-m-d\TH:i');
                    ?>
                    <input type="datetime-local" class="form-control" id="task_date_display" value="{{ $currentDate }}" disabled>
                    <input type="hidden" id="task_date" name="task_date" value="{{ $currentDate }}">
                </div>
            </div>

            <!-- Task status field -->
            <div class="form-group">
                <label for="task_state">Taks State</label>
                <select class="form-control" id="task_state" name="task_state" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Pending Task</button>
        </form>
    </div>
<script src="{{asset('build/assets/js/tasks/taskProject.js')}}"></script>
</body>
</html>
@endsection
