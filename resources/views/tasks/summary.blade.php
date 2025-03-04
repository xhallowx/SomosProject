@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('build/assets/css/tasks/summary.css')}}">
</head>
<body>
    @if(session('error'))
        <div id="alert" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="start">
        <div class="borde">
            <h1 class="title">Owner Chart - Summary</h1>
        </div>
        <div class="container">
            @forelse($summary as $data)
                <div class="summary-item">
                    <p>Owner: <strong>{{ $data['owner'] }}</strong></p>
                    <p>Projects: <strong>{{ $data['projects'] }}</strong></p>
                    <p>Tasks: <strong>{{ $data['tasks'] }}</strong></p>
                    <p>Occupation: <strong>{{ $data['occupancy'] }}%</strong></p>
                </div>
            @empty
                <p><strong>No information found.</strong></p>
            @endforelse
        </div>
    </div>
<script src="{{asset('build/assets/js/tasks/summary.js')}}"></script>
</body>
</html>
@endsection