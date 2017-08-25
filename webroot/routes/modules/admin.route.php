<?php

Route::post('/user/{id}/promote_admin',['as' => 'promote_to_admin', 'uses' => 'UsersController@promoteAdmin']);
Route::post('/user/{id}/revoke_admin',['as' => 'revoke_admin', 'uses' => 'UsersController@revokeAdmin']);
