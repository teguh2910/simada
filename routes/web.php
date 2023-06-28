<?php
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/create', 'HomeController@create');
Route::post('/create', 'HomeController@create_store');
Route::get('/upload/{id}', 'HomeController@upload');
Route::post('/upload/{id}', 'HomeController@upload_store');
Route::get('/feedback/{id}', 'HomeController@feedback');
Route::post('/feedback/{id}', 'HomeController@feedback_store');
Route::get('/viewfeedback/{id}', 'HomeController@viewfeedback');
Route::get('/revise/{id}', 'HomeController@revise');
Route::post('/revise/{id}', 'HomeController@revise_store');
Route::get('/draft', 'HomeController@draft');
Route::get('/final', 'HomeController@final_view');
Route::get('/final/{id}', 'HomeController@final');
Route::get('/overdue', 'HomeController@overdue');
Route::get('/del/{id}', 'HomeController@del');
Route::get('/noneed/{id}', 'HomeController@noneed');
Route::get('/dashboard', 'HomeController@dashboard');
