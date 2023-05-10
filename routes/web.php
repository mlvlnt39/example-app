<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\ShowController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
    Route::get('/posts', 'IndexController@index')->name('post.index');
    Route::get('/posts/create', 'CreateController')->name('post.create');

    Route::post('/posts', 'StoreController')->name('post.store');
    Route::get('/posts/{post}', 'ShowController')->name('posts.show');
    Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
    Route::delete('/posts/{post}', 'DestroyController')->name('post.delete');
});
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::group(['namespace' =>'Post'], function () {
        Route::get('/post', 'IndexController')->name('admin.post.index');

    });

});


Route::get('/main', function () {
    return view('main');
})->name('main.index');
Route::get('/about', 'MainController@index')->name('main.index');
Route::get('/about', 'AboutController@index')->name('about.index');
Route::get('/contact', 'ContactController@index')->name('contact.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

