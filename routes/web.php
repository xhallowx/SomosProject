<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OccupancyController;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class)->where(['task' => '[0-9]+']);
});

Route::get('/tasks/tarea', [TaskController::class, 'showSearchForm'])->name('tasks.tarea');
Route::get('/buscar-tareas', [TaskController::class, 'searchTasks']);

Route::get('/tasks/pending/create', [ProjectTaskController::class, 'create'])->name('project_tasks.create');
Route::post('/tasks/pending/store', [ProjectTaskController::class, 'store'])->name('project_tasks.store');

Route::get('/tasks/pending/{id}/edit', [ProjectTaskController::class, 'edit'])->name('project_tasks.edit');
Route::put('/tasks/pending/{id}', [ProjectTaskController::class, 'update'])->name('project_tasks.update');
Route::delete('/tasks/pending/{id}', [ProjectTaskController::class, 'destroy'])->name('project_tasks.destroy');

Route::get('/observation', [ProjectTaskController::class, 'observation'])->name('tasks.observation');


Route::get('/summary', function () {
    $summary = OccupancyController::getAllOwnersSummary();
    return view('tasks.summary', compact('summary'));
})->name('summary');

Route::get('/check-session', function () {
    return response()->json(['authenticated' => Auth::check()]);
});

require __DIR__.'/auth.php';
