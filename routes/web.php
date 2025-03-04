<?php
namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
//rute pt taskuri --- afisare, creare, stocare, schimbare status si stegere
Route::get('overview',[TaskController::class, 'overview'])->middleware(['auth'])->name('overview');
Route::get('create', [TaskController::class, 'create'])->name('create');
Route::post('create',[TaskController::class, 'store']);
Route::patch('overview/{id}',[TaskController::class, 'update']);
Route::delete('overview/{id}',[TaskController::class, 'delete']);

//rute pt proiecte --- afisare, creare, stocare, stergere
Route::get('projects',[ProjectController::class, 'projects'])->middleware(['auth'])->name('projects');
Route::get('createPr', [ProjectController::class, 'createPr'])->name('createPr');
Route::post('createPr',[ProjectController::class, 'storePr']);
Route::delete('projects/{id}',[ProjectController::class, 'deletePr']);


require __DIR__.'/auth.php';
