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

/*Route::get('/', function () {
    return view('welcome');
});*/

// Route::get('/','PostController@index');


Route::get('/','PostController@index');

Auth::routes();
// Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);
//authentication
/*Route::controllers([
 'auth' => 'Auth\Auth?Controller',
 'password' => 'Auth\PasswordController',
]);*/



Route::get('/logout', 'Auth\LoginController@logout');


// проверка залогиненного пользователя
Route::group(['middleware' => ['auth']], function()
{
 // показ новой пост формы
 Route::get('new-post','PostController@create');
 // сохранение нового поста
 Route::post('new-post','PostController@store');
 // редактирование формы поста
 Route::get('edit/{slug}','PostController@edit');
 // обновление поста
 Route::post('update','PostController@update');
 // удаление поста
 Route::get('delete/{id}','PostController@destroy');
 // вывод всех постов пользователю
 Route::get('my-all-posts','UserController@user_posts_all');
 // вывод пользовательских черновиков
 Route::get('my-drafts','UserController@user_posts_draft');
 // добавление комментариев
 Route::post('comment/add','CommentController@store');
 // удаление комментария
 Route::post('comment/delete/{id}','CommentController@distroy');
});
// пользовательские профили
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// вывод списка постов
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
// вывод одного поста
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
