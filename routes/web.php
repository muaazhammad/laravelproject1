<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function () {
    return view('admin/index');
});


Route::resource('admin/users','AdminUsersController')->middleware('isadmin');
Route::resource('admin/posts','AdminPostsController')->middleware('isadmin');
Route::resource('admin/categories','adminCategoryController')->middleware('isadmin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');







// Route::get('/tt', function () {
//     $user = App\User::find(1);
//     dd($user->role);
// });


