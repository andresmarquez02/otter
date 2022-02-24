<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

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
Route::get("forced/seeder","homeController@seeders");
Route::middleware(['guest'])->group(function () {
    Route::get('/', 'homeController@index');
    Route::get('/login', 'homeController@login')->name('login');
    Route::get('/register', 'homeController@register');
});

Route::get('search/post', 'homeController@search');
Route::get('search/post/category/{id}', 'homeController@search_category');
Route::get('view/post/{id}', 'PostController@view');
Route::get('authors',"AuthorController@authors");
Route::get('view/profile/{id}',"AuthorController@viewProfile");

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'homeController@index');

    //Posts
    Route::get('/create/post', 'PostController@index');
    Route::post('/save/photo', 'PostController@photo');
    Route::get('/edit/post/{id}', 'PostController@edit');
    Route::get('/my/posts', 'PostController@myPosts');

    //Historical
    Route::get('historical',"PostController@historical");

    //Profile
    Route::get('my/profile',"AuthorController@myProfile");

    //Notifications
    Route::get('notifications', 'PostController@notifications');

    //Logout
    Route::get('logout', 'homeController@logout');

    //Admin
    Route::middleware(['admin'])->group(function () {
        Route::get('roles', 'AdminController@roles');
        Route::get('tags', 'AdminController@tags');
        Route::get('categories', 'AdminController@categories');
        Route::get('images/portada', 'AdminController@imgPortada');
        Route::get('image/default', 'AdminController@imgDefault');
        Route::get('users/block', 'AdminController@usersBlocks');
        Route::get('statistical', 'AdminController@statistical');
    });
});
