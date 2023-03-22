<?php

namespace App\Http\Controllers\Exception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PageHandlingController extends Controller
{
    public function showPage404()
    {
        $user = Auth::user();
        $role_id = $user ? $user->role_id : null;
        $name = $user ? $user->name : null;
        $data = [
            "role_id" => $role_id,
            "name" => $name
        ];
        
        return response()->view('pages.error.404.index', $data, Response::HTTP_NOT_FOUND);
    }
}
