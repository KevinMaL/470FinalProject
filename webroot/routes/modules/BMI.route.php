<?php
use App\BMI;
Route::get('/BMI/check','BMIsController@check');
Route::post('/BMI/check','BMIsController@store');
Route::resource('BMI','BMIsController');

