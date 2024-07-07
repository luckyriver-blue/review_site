<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [ReviewController::class, 'Top']);
    Route::get('/hospitals', [ReviewController::class, 'Hospitals'])->name('hospitals');
    Route::get('/hospitals/{hospital}', [ReviewController::class, 'HospitalReview']);
    Route::get('/posts/hospital/create', [ReviewController::class, 'SelectCreate'])->name('create');
    Route::get('/posts/hospital/create/{hospital}', [ReviewController::class, 'create']);
    Route::post('/posts/hospital/create', [ReviewController::class, 'add']);
    Route::post('/posts', [ReviewController::class, 'store']);
    Route::get('/posts/{post}', [ReviewController::class, 'ShowReview']);
    Route::get('/posts/mypage/{user}', [ReviewController::class, 'mypage']);
    Route::post('/posts/mypage', [ReviewController::class, 'updateProfile']);
    Route::get('/posts/mypage/edit/{post}', [ReviewController::class, 'mypost']);
    Route::put('/posts/{post}', [ReviewController::class, 'update']);
    Route::delete('/posts/{post}', [ReviewController::class, 'delete']);
    Route::post('/posts/helpful/{post}', [ReviewController::class, 'helpful']);
    Route::delete('/posts/unhelpful/{post}', [ReviewController::class, 'unHelpful']);
});   

require __DIR__.'/auth.php';