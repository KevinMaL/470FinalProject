<?php

use App\Task;
use App\Contact;
use App\User;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});

Route::get('event',function(){
  $time = Carbon\Carbon::now();
  $users = User::all()->take(5);
  return view('event.event')->with(compact('time','users'));;
});
