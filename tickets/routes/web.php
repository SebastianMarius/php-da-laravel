<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;

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

Route::get('/test', [EventsController::class, 'index']);

// Route::get('/test/CreateEvent', [EventsController::class, 'create'])->middleware('admin');
Route::get('/test/CreateEvent', [EventsController::class, 'create'])->middleware('auth');
Route::get('/events/{eventId}/edit', [EventsController::class,'edit'])->middleware('auth');
Route::put('/events/{eventId}', [EventsController::class, 'update'])->name('events.update');
Route::delete('/events/{eventId}', [EventsController::class, 'destroy'])->middleware('auth');
Route::post('/test/CreateEvent', [EventsController::class, 'store'])->middleware('auth');
Route::post('/test/EditEvent', [EventsController::class, 'editStore'])->middleware('auth');

Route::view('/event/{eventId}/about', 'eventPages.home');
Route::view('/event/{eventId}/speakers', 'eventPages.speakers');
Route::view('/event/{eventId}/partners-and-sponsors', 'eventPages.sponsorsPartners');
Route::view('/event/{eventId}/bilete-inregistrare', 'eventPages.tickets');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
