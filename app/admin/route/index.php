<?php
use think\facade\Route;

Route::resource('post', 'Post');
Route::resource('category', 'Category');
Route::resource('user', 'User');
Route::resource('task', 'Task');
Route::resource('floor', 'Floor');

Route::rule('auth/login', 'Auth/login', 'POST');
Route::rule('category/get_all_category', 'Category/getAllCategory', 'GET');
