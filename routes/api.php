<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Kanban\CardController;
use App\Http\Controllers\Kanban\ColumnController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('')


// Notes API
Route::get('/fetch-notes', [NotesController::class, 'fetch']);
Route::post('/create-notes', [NotesController::class, 'store']);
Route::post('/create-sub-task', [NotesController::class, 'createSubTask']);
Route::delete('/delete-task/{id}', [NotesController::class, 'deleteTask']);
Route::put('/update-sub-task/{id}', [NotesController::class, 'updateSubTask']);
Route::delete('/delete-sub-tasks/{subtask_id}', [NotesController::class, 'deleteSubTask']);

Route::get('/events', [EventController::class, 'index']);
Route::post('/events/store', [EventController::class, 'store'])->name('event.store');


Route::get('/project', [ProjectController::class, 'fetch']);
Route::post('/project/store', [ProjectController::class, 'store']);
Route::get('/project/detail/{id}', [ProjectController::class, 'detail']);


Route::post('/column/store', [ColumnController::class, 'store']);
Route::delete('/column/delete/{id}', [ColumnController::class, 'delete']);


Route::post('/card/store', [CardController::class, 'store']);
Route::delete('/card/delete/{id}', [CardController::class, 'delete']);
Route::post('/update-card-positions', [CardController::class, 'updateCardPositions']);



Route::get('/task-statistics', [HomeController::class, 'taskStatistics']);