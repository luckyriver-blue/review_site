<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

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

Route::get('/', [ReviewController::class, 'HospitalReview']);
Route::get('/posts/create', [ReviewController::class, 'create']);
Route::get('/posts/create', [ReviewController::class, 'OptionDepartment']);
Route::get('/posts/{post}', [ReviewController::class, 'ShowReview']);
Route::post('/posts', [ReviewController::class, 'store']);
