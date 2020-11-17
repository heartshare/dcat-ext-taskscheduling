<?php

namespace Dcat\Admin\Extension\TaskScheduling\Repositories;

use Dcat\Admin\Extension\TaskScheduling\Models\TaskLog as Model;
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
