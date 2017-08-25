<?php
use App\Profile;

Route::get('user/me', ['as' => 'view_profile', 'uses' => 'Profile\ProfileController@showMe']);
Route::get('user/me/edit', ['as' => 'edit_profile', 'uses' => 'Profile\ProfileController@showMe']);
Route::get('user/{id}', ['as' => 'view_profile', 'uses' => 'Profile\ProfileController@show']);
Route::get('user/{id}/edit', ['middleware' => 'admin.site','as' => 'edit_profile', 'uses' => 'Profile\ProfileController@show']);
Route::post('user/{id}/edit/submit', ['as' => 'save_profile', 'uses' => 'Profile\ProfileController@update']);



Route::get('/event/{event_id}', 'Profile\ProfileController@getEvent');
Route::post('/event/{event_id}/remove/me', ['as'=>'remove_me_from_event' ,'uses'=>'Profile\ProfileController@removeMeFromEvent']);
Route::post('/event/{event_id}/add/me', ['as'=>'add_me_to_event' ,'uses'=>'Profile\ProfileController@addMeToEvent']);
