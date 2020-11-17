<?php

namespace Dcat\Admin\Extension\TaskScheduling;

use Dcat\Admin\Extension;

class TaskScheduling extends Extension
{
    const NAME = 'dcat-ext-taskscheduling';

    protected $serviceProvider = TaskSchedulingServiceProvider::class;

    protected $composer = __DIR__ . '/../composer.json';

    protected $migrations = __DIR__ . '/../database/migrations';

    // protected $assets = __DIR__ . '/../resources/assets';

    // protected $views = __DIR__ . '/../resources/views';

    // protected $lang = __DIR__ . '/../resources/lang';

    protected $menu = [
        'title' => '定时任务',
        'path'  => '/task',
        'icon'  => 'feather icon-activity',
    ];
}
