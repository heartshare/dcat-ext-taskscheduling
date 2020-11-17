<?php

namespace Dcat\Admin\Extension\TaskScheduling\Repositories;

use Dcat\Admin\Extension\TaskScheduling\Models\Task as Model;
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
