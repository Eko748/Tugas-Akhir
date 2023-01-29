<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

define('PER_PAGE_LIMIT', 6);

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getAdminId()
    {
        $data = User::with('admin')->find(Auth::user()->id);
        return $data;
    }
    // public function getOwnerId()
    // {
    //     $data = User::with('owner')->find(Auth::user()->id);
    //     return $data;
    // }
}