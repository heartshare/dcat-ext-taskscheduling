<?php

namespace Dcat\Admin\Extension\TaskScheduling\Controllers;

use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Extension\TaskScheduling\Grid\RowAction\TaskExecute;
use Dcat\Admin\Extension\TaskScheduling\Repositories\Task;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Illuminate\Support\Facades\Artisan;

class TaskController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->header('任务')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Task(), function (Grid $grid) {

            $grid->column('id');
            $grid->column('command', '命令');
            $grid->column('description', '描述');
            $grid->column('expression', '时间表达式');
            $grid->column('parameters', '参数');
            $grid->column('notification_email_address', '通知邮件地址');
            $grid->column('state', '状态')->switch();
            $grid->column('dont_overlap', '避免重复')->switch();
            $grid->column('run_in_maintenance', '维护模式')->switch();
            $grid->column('execute', '执行')->action(TaskExecute::class);
            $grid->column('logs', '日志')
                ->prepend(function () {
                    return '查看';
                })->link(function () {
                return admin_url('taskLog/?task_id=' . $this->id);
            });
            $grid->column('created_at');
            $grid->column('updated_at');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal('id')->width(2);
                $filter->whereBetween('created_at', function ($q) {
                    $start = $this->input['start'] ?? null;
                    $end   = $this->input['end'] ?? null;

                    if (!is_null($start) && !is_null($end)) {
                        $q->where('created_at', '>=', $start);
                        $q->where('created_at', '<=', $end);
                    }
                })->datetime()->width(4);
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param  mixed  $id
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Task(), function (Show $show) {
            $show->field('id');
            $show->field('command', '命令');
            $show->field('description', '描述');
            $show->field('expression', '时间表达式');
            $show->field('parameters', '参数');
            $show->field('notification_email_address', '通知邮件地址');
            $show->field('state', '状态')->using([
                0 => '未开启',
                1 => '已开启',
            ])->dot(
                [
                    0 => 'gray',
                    1 => 'success',
                ],
                'gray'
            );
            $show->field('dont_overlap', '避免重复执行')->using([
                0 => '未开启',
                1 => '已开启',
            ])->dot(
                [
                    0 => 'gray',
                    1 => 'success',
                ],
                'gray'
            );
            $show->field('run_in_maintenance', '维护也需执行')->using([
                0 => '未开启',
                1 => '已开启',
            ])->dot(
                [
                    0 => 'gray',
                    1 => 'success',
                ],
                'gray'
            );
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Task(), function (Form $form) {
            $commands = array_keys(Artisan::all());

            $form->display('id');
            $form->select('command', '命令')->options(array_combine($commands, $commands));
            $form->text('description', '描述');
            $form->text('expression', '时间表达式');
            $form->text('parameters', '参数');
            $form->text('notification_email_address', '通知邮件地址');
            $form->switch('state', '状态');
            $form->switch('dont_overlap', '避免重复执行');
            $form->switch('run_in_maintenance', '维护也需执行');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
