<?php
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
Route::get('/callback/{provider}', 'SocialAuthController@callback');