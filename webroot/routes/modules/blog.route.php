<?php
/**
 * Blog create and show
 */

Route::get('/blog/{id}', 'Blog\BlogController@show')->name('blog');

Route::resource('blog', 'Blog\BlogController', ['only' => ['store', 'destroy']]);

Route::get('/blog/{id}/followings', 'Blog\FollowController@followings')->name('followings');

Route::get('/blog/{id}/followers', 'Blog\FollowController@followers')->name('followers');

Route::post('/blog/followers/{id}', 'Blog\FollowController@store')->name('followers.store');

Route::delete('/blog/followers/{id}', 'Blog\FollowController@destroy')->name('followers.destroy');

Route::get('/blogs', 'Blog\BlogController@all')->name('allblogs');

Route::get('/blog/{id}/show', 'Blog\BlogController@show_info')->name('show');



//useful things
Route::get('/blog/{blog_id}/read', 'Blog\BlogController@single_blog')->name('single_blog');

