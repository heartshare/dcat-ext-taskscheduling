<?php

namespace Dcat\Admin\Ext\TaskScheduling\Repositories;

use Dcat\Admin\Ext\TaskScheduling\Models\Task as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Task extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

}
