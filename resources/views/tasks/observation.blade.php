@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('build/assets/css/tasks/observation.css')}}">
</head>
<body>  
    @if(session('success'))
        <div id="alert" class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <h2 class="text-center mb-4">Observación de Proyectos y Tareas</h2>

        @foreach($projects as $project)
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h4>{{ $project->name_project }}</h4>
                    <p>Owner del Proyecto: <strong>{{ $project->owner }}</strong></p>
                </div>
                <div class="card-body">
                    @if($project->projectTasks->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Owner Tarea</th>
                                        <th>Descripción de Tarea</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Fecha de Tarea</th>
                                        <th>Estado de la tarea</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project->projectTasks as $task)
                                        <tr>
                                            <td>{{ $task->owner }}</td>
                                            <td class="task-description">{{ $task->description_task }}</td>
                                            <td>{{ $task->start_date }}</td>
                                            <td>{{ $task->finish_date }}</td>
                                            <td>{{ $task->task_date->format('Y-m-d\-H:i') }}</td>
                                            <td>{{ $task->task_state }}</td>
                                            <td>
                                                <a href="{{ route('project_tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('project_tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta tarea?')">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-warning">No hay tareas asignadas para este proyecto.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
<script src="{{asset('build/assets/js/tasks/observation.js')}}"></script>
</body>
</html>
@endsection
