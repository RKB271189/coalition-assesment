<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/projects', [ProjectController::class, 'details']);
Route::post('/tasks', [TaskController::class, 'create']);
Route::get('/tasks', [TaskController::class, 'fetch']);
Route::get('/tasks/{id}', [TaskController::class, 'fetchSingle']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'delete']);
Route::post('tasks/reorder', [TaskController::class, 'reorder']);
Route::get('/tasks/{project_id}/project', [TaskController::class, 'filter']);
