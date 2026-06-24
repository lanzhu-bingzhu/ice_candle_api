<?php
use think\facade\Route;

Route::rule('v1/task/:name', 'Task/read', 'GET');
Route::rule('v1/task', 'Task/index', 'GET');

Route::rule('v1/category/:category_id/post', 'Post/index', 'GET');

Route::rule('v1/category/:id', 'Category/read', 'GET');
Route::rule('v1/category', 'Category/index', 'GET');

Route::rule('v1/floor', 'Floor/index', 'GET');

Route::rule('v1/post/:id', 'Post/read', 'GET');