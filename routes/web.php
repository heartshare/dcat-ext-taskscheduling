<?php

use Dcat\Admin\Extension\TaskScheduling\Controllers;

Route::resource('task', Controllers\TaskController::class);
Route::resource('taskLog', Controllers\TaskLogController::class);
