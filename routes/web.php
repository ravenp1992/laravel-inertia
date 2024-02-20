<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/projects', ProjectController::class);
    // Route::name('projects.')->group(function () {
    //     Route::get('/projects', [ProjectController::class, 'index'])->name('index');
    //     Route::get('/projects/{project}', [ProjectController::class, 'show'])
    //         ->name('show')
    //         ->whereNumber('project');
    //     Route::get('/projects/create', [ProjectController::class, 'create'])->name('create');
    //     Route::post('/projects', [ProjectController::class, 'store'])->name('store');
    //     Route::patch('/projects/{project}', [ProjectController::class, 'update'])->name('update');
    //     Route::delete('/projects/{project}', [ProjectController::class, 'delete'])->name('delete');
    // });
});

require __DIR__.'/auth.php';