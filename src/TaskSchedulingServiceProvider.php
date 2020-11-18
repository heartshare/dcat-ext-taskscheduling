<?php

namespace Dcat\Admin\Ext\TaskScheduling;

use Dcat\Admin\Admin;
use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Ext\TaskScheduling\Console\Commands\ListSchedule;
use Dcat\Admin\Ext\TaskScheduling\Models\Task;
use Dcat\Admin\Ext\TaskScheduling\Observers\TaskObserver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use ReflectionException;

class TaskSchedulingServiceProvider extends ServiceProvider
{
    /**
     * js资源
     *
     * @var string[]
     */
    protected $js = [
        'js/index.js',
    ];

    /**
     * css资源
     *
     * @var string[]
     */
    protected $css = [
        'css/index.css',
    ];

    /**
     * 定义菜单
     *
     * @var string[][]
     */
    protected $menu = [
        [
            'title' => '定时任务',
            'uri'   => '',
            'icon'  => 'feather icon-clock',
        ],
        [
            'parent' => '定时任务',
            'title'  => '任务',
            'uri'    => '/task',
        ],
        [
            'parent' => '定时任务',
            'title'  => '日志',
            'uri'    => '/taskLog',
        ],
    ];

    /**
     * 注册服务
     *
     * @return void
     */
    public function register()
    {
        /**
         * 注册自定义命令
         */
        $this->commands([
            ListSchedule::class,
        ]);

        // 注册运行定时任务调度服务
        try {
            if (Schema::hasTable('tasks')) {
                $this->app->register(TaskRunServiceProvider::class);
            }
        } catch (\PDOException $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * 初始化
     *
     * @throws ReflectionException
     * @return void
     */
    public function init()
    {
        parent::init();

        // 注册数据模型事件
        Task::observe(TaskObserver::class);
    }

    /**
     * 设置表单
     *
     * @return Setting
     */
    public function settingForm()
    {
        return new Setting($this);
    }
}
