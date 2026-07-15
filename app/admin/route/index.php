<?php
use think\facade\Route;

Route::rule('auth/login', 'Auth/login', 'POST');
Route::rule('category/get_all_category', 'Category/getAllCategory', 'GET');
Route::rule('post_tag/get_all_post_tag', 'PostTag/getAllPostTag', 'GET');

Route::resource('post', 'Post');
Route::resource('category', 'Category');
Route::resource('user', 'User');
Route::resource('task', 'Task');
Route::resource('floor', 'Floor');
Route::resource('upload', 'Upload');
