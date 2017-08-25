<?php
use App\Calories;
Route::get('/calories/check','CaloriesController@check');
Route::post('/calories/check','CaloriesController@store');
Route::resource('calories','CaloriesController');

