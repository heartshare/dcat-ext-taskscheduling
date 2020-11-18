<?php

namespace Dcat\Admin\Ext\TaskScheduling\Observers;

use Dcat\Admin\Ext\TaskScheduling\Models\Task;
use Illuminate\Support\Facades\Cache;

class TaskObserver
{
    /**
     * 监听用户保存完成的事件
     *
     * @param  Task   $task
     * @return void
     */
    public function saved(Task $task)
    {
        Cache::forget('nivin.task.all');
        Cache::forget('nivin.task.active');
    }

    /**
     * 监听用户删除完成事件
     *
     * @param  Task   $task
     * @return void
     */
    public function deleted(Task $task)
    {
        Cache::forget('nivin.task.all');
        Cache::forget('nivin.task.active');
    }
}
