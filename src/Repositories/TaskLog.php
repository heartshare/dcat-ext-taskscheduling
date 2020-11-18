<?php

namespace Dcat\Admin\Ext\TaskScheduling\Repositories;

use Dcat\Admin\Ext\TaskScheduling\Models\TaskLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class TaskLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

}
