<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TramsController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'homeIndex']);
Route::post('/contactSend', [HomeController::class, 'contactSend']);

Route::get('/course', [CourseController::class, 'courseIndex']);
Route::get('/project', [ProjectController::class, 'projectIndex']);
Route::get('/terms', [TramsController::class, 'termsIndex']);
Route::get('/policy', [PolicyController::class, 'policyIndex']);
Route::get('/contact', [ContactController::class, 'contactIndex']);

