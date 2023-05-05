<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

class ProjectController extends ManagementController
{
    private string $page = 'Project';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showProject($uuid_project)
    {
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->page,
            'uuid_project' => $uuid_project
        ];
        return view('pages.management.project.index', $this->data);
    }


}
