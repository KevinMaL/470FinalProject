<?php

use App\Message;

Route::get('/user/message', 'Message\MessageController@myMessages');
Route::get('/user/message/unread', 'Message\MessageController@unread');
Route::get('/user/message/thread/{their_uid}', 'Message\MessageController@thread');
Route::post('/user/message/send/{their_uid}', ['as' => 'send_message', 'uses' => 'Message\MessageController@send']);

Route::post('/user/message/unread/readall', ['as' => 'read_all_message', 'uses' => 'Message\MessageController@readAll']);
Route::get('/user/message/new', ['as' => 'new_message', 'uses' => 'Message\MessageController@new']);
Route::post('/user/message/new/submit', ['as' => 'send_new_message', 'uses' => 'Message\MessageController@newSubmit']);
Route::post('/user/message/thread/{their_uid}/remove', ['as' => 'remove_thread', 'uses' => 'Message\MessageController@removeThread']);
