@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('build/assets/css/tasks/observation.css') }}">
</head>
<body>
  @if(session('success'))
      <div id="alert" class="alert alert-success text-center">
          {{ session('success') }}
      </div>
  @endif

  <div class="container">
    <h2 class="text-center mb-4">Observación de Proyectos y Tareas</h2>

    <!-- Tabla para filtros de búsqueda -->
    <form action="{{ route('tasks.observation') }}" method="GET" class="mb-4 p-3 border rounded">
        <h3>Realiza una búsqueda</h3>
        <div class="filter">
            <div class="form-group">
                <label for="owner" class="field">Owner:</label>
                <select name="owner" id="owner" class="form-control select">
                    <option value="Seleccionar">Seleccionar</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner }}" {{ request('owner') == $owner ? 'selected' : '' }}>{{ $owner }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="project" class="field">Proyecto:</label>
                <select name="project" id="project" class="form-control select">
                    <option value="Seleccionar">Seleccionar</option>
                    @foreach($projectNames as $project)
                        <option value="{{ $project }}" {{ request('project') == $project ? 'selected' : '' }}>{{ $project }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="search">Buscar</button>
        </div>
    </form>


    <!-- Verificación si se encontraron proyectos -->
    @if($projects->isEmpty())
      <p class="text-center text-danger">proyecto no encontrado</p>
    @else
      <!-- Tabla de proyectos y tareas -->
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
                                <th>Owner</th>
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
    @endif
  </div>
  <script src="{{ asset('build/assets/js/tasks/observation.js') }}"></script>
</body>
</html>
@endsection
