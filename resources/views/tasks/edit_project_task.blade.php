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
        <h2 class="text-center mb-4">Editar Tarea Pendiente para el Proyecto: <p class="name">{{ $projectTask->project->name_project }}</p></h2>
        
        @if(session('success'))
            <div id="alert" class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('project_tasks.update', $projectTask->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Campo para el proyecto (inhabilitado) -->
            <div class="form-group">
                <label for="name_project_display">Proyecto</label>
                <input type="text" class="form-control" id="name_project_display" value="{{ $projectTask->project->name_project }}" disabled>
                <input type="hidden" id="project_id" name="project_id" value="{{ $projectTask->project_id }}">
            </div>

            <!-- Seleccionar el owner de la tarea pendiente -->
            <div class="form-group">
                <label for="owner">Owner de la Tarea</label>
                <select class="form-control" id="owner" name="owner" required>
                    <option value="">Seleccionar</option>
                    @foreach(['Sebastian', 'Samir', 'Diego', 'Edwin', 'Bryan', 'Erick'] as $owner)
                        <option value="{{ $owner }}" {{ $projectTask->owner == $owner ? 'selected' : '' }}>{{ $owner }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Descripción de la tarea pendiente -->
            <div class="form-group">
                <label for="description_task">Descripción de la Tarea</label>
                <textarea class="form-control descripcion" id="description_task" name="description_task" rows="4" required>{{ $projectTask->description_task }}</textarea>
            </div>

            <!-- Campos de fecha -->
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="start_date">Fecha Inicio</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $projectTask->start_date }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="finish_date">Fecha Fin</label>
                    <input type="date" class="form-control" id="finish_date" name="finish_date" value="{{ $projectTask->finish_date }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="task_date_display">Fecha de Tarea (Edición)</label>
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
                    <option class="option" value="Pending" {{ $projectTask->task_state == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option class="option" value="In Progress" {{ $projectTask->task_state == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option class="option" value="Completed" {{ $projectTask->task_state == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
            <a href="{{ route('tasks.observation') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
<script src="{{asset('build/assets/js/tasks/editProjectTask.js')}}"></script>
</body>
</html>
@endsection