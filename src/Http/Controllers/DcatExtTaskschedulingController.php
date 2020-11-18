<?php

namespace Dcat\Admin\Ext\TaskScheduling\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Routing\Controller;

class DcatExtTaskschedulingController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(Admin::view('nivin-studio.dcat-ext-taskscheduling::index'));
    }
}