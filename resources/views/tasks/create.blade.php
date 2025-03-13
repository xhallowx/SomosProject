@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="{{asset('build/assets/css/tasks/create.css')}}">
</head>
<body>
    @if (session('success'))
        <div id="alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h2 class="mb-4 register">Register Projects</h2>

        {{-- Formulario de creación de tareas --}}
        <form action="{{ route('tasks.store') }}" method="POST" class="principal confirm-form">
            @csrf
            <div class="mb-3">
                <label for="name_project" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="name_project" name="name_project" required>
            </div>

            <div class="mb-3">
                <label for="owner" class="form-label">Owner</label>
                <select class="form-control" id="owner" name="owner" required>
                    <option value="" disabled selected>Select Owner</option>
                    @foreach($users as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="request_area" class="form-label">Request Area</label>
                <input type="text" class="form-control" id="request_area" name="request_area" required>
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="request_date" class="form-label">Request Date</label>
                <input type="date" class="form-control" id="request_date" name="request_date" required>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="mb-3">
                <label for="finish_date" class="form-label">Finish Date</label>
                <input type="date" class="form-control" id="finish_date" name="finish_date" required>
            </div>

            <div class="mb-3">
                <label for="project_description" class="descrip">Project Description</label>
                <textarea class="descripcion" id="project_description" name="project_description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="project_state" class="form-label">Project State</label>
                <select class="form-control" id="project_state" name="project_state" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Blocked">Blocked</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <hr>

        <!-- Select Owner -->
        <div class="mb-3 owner">
            <label for="filterOwner" class="filter">Search by Owner : </label>
            <select class="select" id="filterOwner">
                <option value="">Select</option>
                @foreach ($tasks->pluck('owner')->unique() as $owner)
                    <option value="{{ $owner }}">{{ $owner }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tabla de tareas registradas --}}
        <div class="PR">
            <h2 class="mt-5 register">Registered Projects</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Owner</th>
                        <th>Request Area</th>
                        <th>Priority</th>
                        <th>Request Date</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                        <th>Project Description</th>
                        <th>Project State</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="taskTable">
                    @forelse ($tasks as $task)
                        <tr class="task-row" data-owner="{{ $task->owner }}">
                            <td>{{ $task->name_project }}</td>
                            <td>{{ $task->owner }}</td>
                            <td>{{ $task->request_area }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->request_date }}</td>
                            <td>{{ $task->start_date }}</td>
                            <td>{{ $task->finish_date }}</td>
                            <td style="max-width: 100px; white-space: normal; word-wrap: break-word; overflow-wrap: break-word;">{{ $task->project_description }}</td>
                            <td>{{ $task->project_state }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm btnEdit">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btnDelete" onclick="return confirm('You´re sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center"><strong>there are no registered projects.</strong></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>     
        <div class="caja"></div>
    </div>
<script src="{{asset('build/assets/js/tasks/create.js')}}"></script>
</body>
</html>
@endsection