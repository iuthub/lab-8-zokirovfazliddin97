<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
    'uses' => 'PostController@getIndex',
    'as' => 'blog.index'
]);

Route::get('post/{id}', [
    'uses' => 'PostController@getPost',
    'as' => 'blog.post'
]);

Route::get("post/like/{id}", [
    'uses'=>"PostController@postLike",
    'as'=>"blog.like"
]);

Route::get('about', function () {
    return view('other.about');
})->name('other.about');

Route::group(['prefix' => 'admin'], function() {
    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postAdminUpdate',
        'as' => 'admin.update'
    ]);

    Route::get('delete/{id}', [
        'uses'=>'PostController@postAdminDelete', 
        'as'=>'admin.delete'
    ]);

    Route::get('tag/create', [
        'uses'=>'PostController@tagGetAdminCreate',
        'as'=>'admin.tag.create'
    ]);

    Route::post("tag/store", [
        'uses'=>"PostController@tagPostAdminCreate",
        'as'=>'admin.tag.store'
    ]);

    Route::get('tag/edit/{id}', [
        'uses'=>"PostController@tagAdminEdit", 
        'as'=>"admin.tag.edit"
    ]);

    Route::post("tag/update/{id}", [
        'uses'=>"PostController@tagAdminUpdate",
        'as'=>'admin.tag.update'
    ]);

    Route::get("tag/delete/{id}", [
        'uses'=>"PostController@tagAdminDelete",
        'as'=>"admin.tag.delete"
    ]);

});