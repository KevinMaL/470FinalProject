<?php

use App\Group;
use App\GroupMember;

Route::get('/admin/user', ['middleware' => 'admin.site', 'uses' => 'UsersController@allUsers']);
Route::get('/admin/group', 'Group\GroupAdminController@allGroups');
Route::get('/admin/group/{id}', 'Group\GroupAdminController@manageGroup');


Route::get('/group/{id}', 'Group\GroupController@viewGroup');
Route::get('/mygroups', 'Group\GroupController@joinedGroups');

Route::get('/allgroups',  'HomeController@viewAllGroups');

Route::get('/group/{group_id}/post/{post_id}',['as' => 'view_group_post', 'uses' => 'Group\GroupController@viewGroupPost']);
Route::post('/group/{group_id}/post/{post_id}/submit',['as' => 'reply_post', 'uses' => 'Group\GroupController@replyPost']);
Route::post('/group/{group_id}/post/new',['as' => 'new_post', 'uses' => 'Group\GroupController@newPost']);


Route::post('/group/{group_id}/admin/new',['as' => 'new_group_admin', 'uses' => 'Group\GroupAdminController@newAdmin']);
Route::post('/group/{group_id}/admin/{user_id}/remove',['as' => 'remove_group_admin', 'uses' => 'Group\GroupAdminController@removeAdmin']);

Route::post('/group/{group_id}/member/new',['as' => 'new_group_member', 'uses' => 'Group\GroupAdminController@newMember']);
Route::post('/group/{group_id}/member/{user_id}/remove',['as' => 'kick_member', 'uses' => 'Group\GroupAdminController@removeMember']);
