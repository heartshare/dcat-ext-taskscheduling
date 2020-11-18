<?php

use Dcat\Admin\Ext\TaskScheduling\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('dcat-ext-taskscheduling', Controllers\DcatExtTaskschedulingController::class.'@index');