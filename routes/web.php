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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cms/', 'HomeController@cms')->name('cms');


Route::get('/cms/album', 'AlbumController@indexAlbum')->name('album');
Route::post('/cms/album', 'AlbumController@createAlbum');
Route::get('/cms/album/{id}', 'AlbumController@editAlbum');
Route::post('/cms/album/{id}', 'AlbumController@updateAlbum');
Route::get('/cms/album/delete/{id}', 'AlbumController@deleteAlbum');

Route::get('/cms/album/photo/{id}', 'AlbumController@indexPhoto');
Route::post('/cms/album/photo/{id}', 'AlbumController@createPhoto');
Route::get('/cms/album/photo/delete/{id}', 'AlbumController@deletePhoto');

Route::get('/cms/publish', 'PostController@indexPost')->name('publish');
Route::get('/cms/post', 'PostController@Post');
Route::post('/cms/publish', 'PostController@createPost');
Route::get('/cms/publish/{id}', 'PostController@editPost')->name('editpublish');
Route::post('/cms/publish/{id}', 'PostController@updatePost');
Route::get('/cms/post/delete/{id}', 'PostController@deletePost');


Route::get('/cms/category', 'PostController@indexCategory')->name('category');
Route::post('/cms/category', 'PostController@createCategory');
Route::get('/cms/category/{id}', 'PostController@editCategory');
Route::post('/cms/category/{id}', 'PostController@updateCategory');
Route::get('/cms/category/delete/{id}', 'PostController@deleteCategory');

Route::get('/cms/work', 'WorkController@indexWork');
Route::post('/cms/work/', 'WorkController@createWork');
Route::get('/cms/work/{id}', 'WorkController@editWork');
Route::post('/cms/work/{id}', 'WorkController@updateWork');
Route::get('/cms/work/delete/{id}', 'WorkController@deleteWork');

Route::get('/cms/portfolio', 'WorkController@indexPortfolio')->name('work');
Route::post('/cms/portfolio', 'WorkController@createPortfolio');
Route::get('/cms/portfolio/{id}', 'WorkController@editPortfolio');
Route::post('/cms/portfolio/{id}', 'WorkController@updatePortfolio');
Route::get('/cms/portfolio/delete/{id}', 'WorkController@deletePortfolio');

Route::get('/cms/profile', 'UserController@indexProfile');
Route::post('/cms/profile/', 'UserController@createProfile');

Route::get('/cms/user', 'UserController@indexUser');
Route::post('/cms/user', 'UserController@createUser');
Route::get('/cms/user/{id}', 'UserController@editUser');
Route::post('/cms/user/{id}', 'UserController@updateUser');
Route::get('/cms/user/delete/{id}', 'UserController@deleteUser');


Route::post('/cms/profile/', 'UserController@createProfile');


