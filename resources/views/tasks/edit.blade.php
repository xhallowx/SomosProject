@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="{{asset('build/assets/css/tasks/create.css')}}">
</head>
<body>
    <div class="container">
        <h2 class="mb-4 edit">Edit Project</h2>

        @if (session('success'))
            <div id="alert" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="principal confirm-form">
            @csrf
            @method('PUT')

            <a href="{{ route('tasks.create') }}" class="btn-secondary">Back</a>

            <div class="mb-3">
                <label for="name_project" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="name_project" name="name_project" value="{{ $task->name_project }}" required>
            </div>

            <div class="mb-3">
                <label for="owner" class="form-label">Owner</label>
                <select class="form-control" id="owner" name="owner" required>
                    <option value="Sebastian" {{ $task->owner == 'Sebastian' ? 'selected' : '' }}>Sebastian</option>
                    <option value="Samir" {{ $task->owner == 'Samir' ? 'selected' : '' }}>Samir</option>
                    <option value="Diego" {{ $task->owner == 'Diego' ? 'selected' : '' }}>Diego</option>
                    <option value="Edwin" {{ $task->owner == 'Edwin' ? 'selected' : '' }}>Edwin</option>
                    <option value="Bryan" {{ $task->owner == 'Bryan' ? 'selected' : '' }}>Bryan</option>
                    <option value="Erick" {{ $task->owner == 'Erick' ? 'selected' : '' }}>Erick</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="request_area" class="form-label">Request Area</label>
                <input type="text" class="form-control" id="request_area" name="request_area" value="{{ $task->request_area }}" required>
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="request_date" class="form-label">Request Date</label>
                <input type="date" class="form-control" id="request_date" name="request_date" value="{{ $task->request_date }}" required>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $task->start_date }}" required>
            </div>

            <div class="mb-3">
                <label for="finish_date" class="form-label">Finish Date</label>
                <input type="date" class="form-control" id="finish_date" name="finish_date" value="{{ $task->finish_date }}" required>
            </div>

            <div class="mb-3">
                <label for="project_description" class="form-label">Project Description</label>
                <textarea class="descripcion" id="project_description" name="project_description" rows="3" required>{{ $task->project_description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="project_state" class="form-label">Project State</label>
                <select class="form-control" id="project_state" name="project_state" required>
                    <option value="Pending" {{ $task->project_state == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ $task->project_state == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ $task->project_state == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <div class="caja"></div>
@endsection
<script src="{{asset('build/assets/js/tasks/create.js')}}"></script>
</body>
</html>