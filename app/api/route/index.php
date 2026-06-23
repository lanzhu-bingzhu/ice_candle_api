<?php
use think\facade\Route;

Route::rule('v1/task/:name', 'Task/read', 'GET');
Route::rule('v1/task', 'Task/index', 'GET');

Route::rule('v1/category', 'Category/index', 'GET');

Route::rule('v1/floor', 'Floor/index', 'GET');