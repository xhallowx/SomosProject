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
        <h2 class="text-center mb-4">Asignar Tarea Pendiente al Proyecto: <p class="name">{{ $project->name_project }}</p></h2>
        
        @if(session('success'))
            <div id="alert" class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('project_tasks.store') }}" method="POST" class="confirm-form">
            @csrf
            <!-- Campo para el proyecto (inhabilitado) -->
            <div class="form-group">
                <label for="name_project_display">Proyecto</label>
                <input type="text" class="form-control" id="name_project_display" value="{{ $project->name_project }}" disabled>
                <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}">
            </div>

            <!-- Seleccionar el owner de la tarea pendiente -->
            <div class="form-group">
                <label for="owner">Owner de la Tarea</label>
                <select class="form-control" id="owner" name="owner" required>
                    <option value="">Seleccionar</option>
                    @foreach(['Sebastian', 'Samir', 'Diego', 'Edwin', 'Bryan', 'Erick'] as $owner)
                        <option value="{{ $owner }}">{{ $owner }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Descripción de la tarea pendiente -->
            <div class="form-group">
                <label for="description_task">Descripción de la Tarea</label>
                <textarea class="form-control descripcion" id="description_task" name="description_task" rows="4" required></textarea>
            </div>

            <!-- Campos de fecha -->
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="start_date">Fecha Inicio</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="finish_date">Fecha Fin</label>
                    <input type="date" class="form-control" id="finish_date" name="finish_date" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="task_date_display">Fecha de Tarea (Creación)</label>
                    <!-- Se muestra la fecha y hora actual y se bloquea la edición -->
                    <?php
                        // Configurar la zona horaria a Colombia antes de mostrar la fecha
                        date_default_timezone_set('America/Bogota');
                        $currentDate = date('Y-m-d\TH:i');
                    ?>
                    <input type="datetime-local" class="form-control" id="task_date_display" value="{{ $currentDate }}" disabled>
                    <input type="hidden" id="task_date" name="task_date" value="{{ $currentDate }}">
                </div>
            </div>

            <!-- Campo para el estado de la tarea -->
            <div class="form-group">
                <label for="task_state">Estado de la Tarea</label>
                <select class="form-control" id="task_state" name="task_state" required>
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Asignar Tarea Pendiente</button>
        </form>
    </div>
<script src="{{asset('build/assets/js/tasks/taskProject.js')}}"></script>
</body>
</html>
@endsection
