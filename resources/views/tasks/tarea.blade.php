@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('build/assets/css/tasks/tarea.css')}}">
</head>
<body>
    <div class="container">
        <h2>Search for Projects</h2>

        <!-- Formulario de búsqueda -->
        <div class="card">
            <div class="card-body">
                <form id="searchForm">
                    <div class="form">
                        <div class="">
                            <label for="owner">Select Owner:</label>
                            <select id="owner" class="form-control">
                                <option value="">Select</option>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner }}">{{ $owner }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="project">Select a Project (Optional):</label>
                            <select id="project" class="form-control">
                                <option value="">Select</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project }}">{{ $project }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="boton">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Resultados de la búsqueda -->
        <div id="results" class="results">
            <p class="sin"><strong> Perform a Search.</strong></p>
        </div>
    </div>
<script src="{{asset('build/assets/js/tasks/tarea.js')}}"></script>
</body>
</html>
@endsection