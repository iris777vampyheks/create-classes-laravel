<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\PhotoController;
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


// for classes
Route::resource('classes', ClasseController::class);
Route::get('/', [ClasseController::class, 'index'])->name('home.index');
Route::get('/classes', [ClasseController::class, 'index'])->name('classe.index');
Route::post('/classes/store', [ClasseController::class, 'store'])->name('classe.store');
Route::get('/classes/show/{id}', [ClasseController::class, 'show'])->name('classes.show');
Route::put('/classes/{id}', [ClasseController::class, 'update'])->name('classe.update');
Route::delete('/classes/{id}', [ClasseController::class, 'destroy'])->name('classe.destroy');
Route::put('/classes/{id}', [ClasseController::class, 'update'])->name('classe.update');

// PhotoController for image uploads
Route::post('/classes/{id}/upload-images', [PhotoController::class, 'uploadImages'])->name('upload.images');
// for upload images
Route::post('/classes/upload/{id}', [PhotoController::class, 'upload'])->name('classe.upload');
//for image modal delete 
Route::delete('/classes/{classe}/photos/{photo}', [PhotoController::class, 'destroy'])
    ->name('classe.destroy.photo');
    //for image modal update
Route::delete('/classes/{classe}/photos/{photo}', [PhotoController::class, 'update'])
->name('classe.update.photo');

// Route for deleting a photo in a class
Route::delete('/classes/{classe}/photos/{photo}', [PhotoController::class, 'destroy'])
    ->name('classe.destroy.photo');
// route for editing a photo in a class

    Route::put('/classes/{classe}/photos/{photo}/update', [PhotoController::class, 'update'])
    ->name('classe.update.photo');

