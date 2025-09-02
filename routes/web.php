<?php

use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/create', [HomeController::class, 'create'])->name('create');
Route::post('/create', [HomeController::class, 'create_store'])->name('create.store');
Route::get('/upload/{id}', [HomeController::class, 'upload'])->name('upload');
Route::post('/upload/{id}', [HomeController::class, 'upload_store'])->name('upload.store');
Route::get('/feedback/{id}', [HomeController::class, 'feedback'])->name('feedback');
Route::post('/feedback/{id}', [HomeController::class, 'feedback_store'])->name('feedback.store');
Route::get('/viewfeedback/{id}', [HomeController::class, 'viewfeedback'])->name('viewfeedback');
Route::get('/revise/{id}', [HomeController::class, 'revise'])->name('revise');
Route::post('/revise/{id}', [HomeController::class, 'revise_store'])->name('revise.store');
Route::get('/draft', [HomeController::class, 'draft'])->name('draft');
Route::get('/final', [HomeController::class, 'final_view'])->name('final.view');
Route::get('/final/{id}', [HomeController::class, 'final'])->name('final');
Route::get('/overdue', [HomeController::class, 'overdue'])->name('overdue');
Route::get('/del/{id}', [HomeController::class, 'del'])->name('del');
Route::get('/noneed/{id}', [HomeController::class, 'noneed'])->name('noneed');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// RFQ Routes
Route::resource('rfq', App\Http\Controllers\RFQController::class);
Route::get('/rfq/{rfq}/select-suppliers', [App\Http\Controllers\RFQController::class, 'selectSuppliers'])->name('rfq.select-suppliers');
Route::post('/rfq/{rfq}/select-suppliers', [App\Http\Controllers\RFQController::class, 'storeSuppliers'])->name('rfq.store-suppliers');