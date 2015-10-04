<?php

// Blog pages
get('/', function () {
    return redirect('/posts');
});

Route::get('posts', [
    'uses'  => 'BlogController@index',
    'as'    => 'posts'
]);

Route::get('/posts/{slug}', [
    'as'    => 'post',
    'uses'  => 'BlogController@showPost'
]);

// Admin area
get('admin', function () {
    return redirect('/admin/post');
});
$router->group([
    'namespace' => 'Admin',
    'middleware' => 'auth',
], function () {
    resource('admin/post', 'PostController', ['except' => 'show']);
});

// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');