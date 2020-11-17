<?php

namespace Dcat\Admin\Extension\TaskScheduling;

use Dcat\Admin\Extension\TaskScheduling\Console\Commands\ListSchedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class TaskSchedulingServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $extension = Taskscheduling::make();

        // if ($views = $extension->views()) {
        //     $this->loadViewsFrom($views, Taskscheduling::NAME);
        // }

        // if ($lang = $extension->lang()) {
        //     $this->loadTranslationsFrom($lang, Taskscheduling::NAME);
        // }

        if ($migrations = $extension->migrations()) {
            $this->loadMigrationsFrom($migrations);
        }

        $this->app->booted(function () use ($extension) {
            $extension->routes(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            ListSchedule::class,
        ]);

        // 注册定时任务控制处理服务
        try {
            if (Schema::hasTable('tasks')) {
                $this->app->register(ConsoleServiceProvider::class);
            }
        } catch (\PDOException $ex) {
            Log::error($ex->getMessage());
        }
    }
}
