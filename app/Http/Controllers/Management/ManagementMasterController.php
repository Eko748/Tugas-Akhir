<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagementMasterController extends Controller
{
    protected string $parent = 'Management';
    private string $child;
    private array $data;

    public function __construct()
    {
        $this->child = 'Master';
        $this->data = [
            'parent' => $this->parent,
            'child' => $this->child
        ];
    }

    public function showManagement()
    {
        return view('pages.management.master.index', $this->data);
    }
}
