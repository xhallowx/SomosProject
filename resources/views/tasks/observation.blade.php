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
    <h2 class="text-center mb-4">Observation of Projects and Tasks</h2>

    <!-- Tabla para filtros de búsqueda -->
    <form action="{{ route('tasks.observation') }}" method="GET" class="mb-4 p-3 border rounded">
        <h3>Perform a search</h3>
        <div class="filter">
            <div class="form-group">
                <label for="owner" class="field">Owner:</label>
                <select name="owner" id="owner" class="form-control select">
                    <option value="Seleccionar">Select</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner }}" {{ request('owner') == $owner ? 'selected' : '' }}>{{ $owner }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="project" class="field">Project:</label>
                <select name="project" id="project" class="form-control select">
                    <option value="Seleccionar">Select</option>
                    @foreach($projectNames as $project)
                        <option value="{{ $project }}" {{ request('project') == $project ? 'selected' : '' }}>{{ $project }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="search">Search</button>
        </div>
    </form>


    <!-- Verificación si se encontraron proyectos -->
    @if($projects->isEmpty())
      <p class="text-center text-danger noFound"><strong> Project not found.</strong></p>
    @else
      <!-- Tabla de proyectos y tareas -->
      @foreach($projects as $project)
        <div class="card mb-3">
          <div class="card-header bg-primary text-white">
            <h4>{{ $project->name_project }}</h4>
            <p>Project Owner: <strong>{{ $project->owner }}</strong></p>
            <p>Tasks : <strong>{{$project->projectTasks->count()}}</strong></p>
          </div>
          <div class="card-body">
            @if($project->projectTasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Owner</th>
                                <th>Task Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Task Date</th>
                                <th>Task State</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalTasks = $project->projectTasks->count();
                            @endphp

                            @if($totalTasks <= 2)
                                @foreach($project->projectTasks as $task)
                                    <tr class="task-row">
                                        <td>{{ $task->owner }}</td>
                                        <td class="task-description">{{ $task->description_task }}</td>
                                        <td>{{ $task->start_date }}</td>
                                        <td>{{ $task->finish_date }}</td>
                                        <td>{{ $task->task_date->format('Y-m-d\-H:i') }}</td>
                                        <td>{{ $task->task_state }}</td>
                                        <td>
                                            <a href="{{ route('project_tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('project_tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Are you sure to delete this task?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                {{-- Mostrar las 2 primeras tareas normalmente --}}
                                @foreach($project->projectTasks as $index => $task)
                                    @if($index < 2)
                                        <tr class="task-row">
                                            <td>{{ $task->owner }}</td>
                                            <td class="task-description">{{ $task->description_task }}</td>
                                            <td>{{ $task->start_date }}</td>
                                            <td>{{ $task->finish_date }}</td>
                                            <td>{{ $task->task_date->format('Y-m-d\-H:i') }}</td>
                                            <td>{{ $task->task_state }}</td>
                                            <td>
                                                <a href="{{ route('project_tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('project_tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Are you sure to delete this task?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @elseif($index == 2)
                                        <tr class="task-row preview-task">
                                            <td>{{ $task->owner }}</td>
                                            <td class="task-description">{{ $task->description_task }}</td>
                                            <td>{{ $task->start_date }}</td>
                                            <td>{{ $task->finish_date }}</td>
                                            <td>{{ $task->task_date->format('Y-m-d\-H:i') }}</td>
                                            <td>{{ $task->task_state }}</td>
                                            <td>
                                                <a href="{{ route('project_tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('project_tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Are you sure to delete this task?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr class="preview-button-row">
                                            <td colspan="7" class="text-center">
                                                <button type="button" class="btn btn-primary btn-visualizar"><strong>See {{$project->projectTasks->count()-2}} more</strong></button>
                                            </td>
                                        </tr>
                                    @else
                                        {{-- Tareas adicionales ocultas por defecto --}}
                                        <tr class="task-row additional-task" style="display: none;">
                                            <td>{{ $task->owner }}</td>
                                            <td class="task-description">{{ $task->description_task }}</td>
                                            <td>{{ $task->start_date }}</td>
                                            <td>{{ $task->finish_date }}</td>
                                            <td>{{ $task->task_date->format('Y-m-d\-H:i') }}</td>
                                            <td>{{ $task->task_state }}</td>
                                            <td>
                                                <a href="{{ route('project_tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('project_tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Are you sure to delete this task?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                {{-- Fila con botón “Ocultar” para colapsar nuevamente la lista --}}
                                <tr class="ocultar-row" style="display: none;">
                                    <td colspan="7" class="text-center">
                                        <button type="button" class="btn btn-secondary btn-ocultar"><strong>See Less</strong></button>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                    </table>
                </div>
            @else
                <p class="text-warning">There are no tasks assigned for this project.</p>
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
