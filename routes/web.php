<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\QueueController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/admin', function() {
    return view('admin.dashboard');
})->middleware(['auth', 'role:Admin']);

//semua route di dalam group ini hanya bisa diakses oleh user yang login
Route::middleware(['auth'])->group(function() {
    Route::resource('patients', PatientController::class);
});

Route::middleware(['auth'])->group(function() {
    Route::resource('appointments', AppointmentController::class);
});

Route::middleware(['auth'])->group(function() {
    Route::get('/queues', [QueueController::class, 'index'])->name('queues.index');
    Route::post('/queues/enqueue/{appointment}', [QueueController::class, 'enqueue'])->name('queues.enqueue');
    Route::post('/queues/call-next', [QueueController::class, 'callNext'])->name('queues.callNext');
    Route::post('/queues/{queue}/done', [QueueController::class, 'done'])->name('queues.done');
});