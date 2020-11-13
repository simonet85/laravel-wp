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



Route::resource('blog','Blog\BlogController');

Route::resource('category','Category\CategoryController');

Route::resource('author','Author\AuthorController');

Route::get('/', ['uses'=>'Blog\BlogController@index', 'as'=>'blog']);

Route::get('/post', function () {
    return view('blog.post');
});
Route::get('/blog/tag/{tag}','Blog\BlogController@tag')->name('tag');
Route::post('/blog/comment/', 'Blog\BlogController@comment')->name('comments');

// Route::get('/404', function () {
//     return view('errors.404');
// });
Auth::routes();

Route::group(['middleware' => ['check-permission']], function () {

    Route::get('/home', 'Backend\HomeController@index')->name('home');
    Route::resource('admin', 'Backend\BackendController')->names(['admini'=>'admini.create']);
    Route::put('/admin/restore/{id}', 'Backend\BackendController@restore')->name('admin.restore');

    Route::get('/trash', 'Backend\BackendController@index')->name('trash');

    Route::delete('/admin/force-destroy/{id}', 'Backend\BackendController@forcedestroy')->name('admin.force-destroy');
    Route::resource('categories', 'Backend\CategoryController');
    Route::resource('tags', 'Backend\TagsController');
    Route::resource('users', 'Backend\UserController');

});

Route::resource('accounts', 'Backend\AccountController');
