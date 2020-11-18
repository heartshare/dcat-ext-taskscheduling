<?php

use Dcat\Admin\Ext\TaskScheduling\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource('task', Controllers\TaskController::class);
Route::resource('taskLog', Controllers\TaskLogController::class);
