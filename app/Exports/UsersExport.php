<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function view(): View
    {
        $users = User::where('created_by', Auth::user()->id)->get();
        $data = [
            "users" => $users,
        ];
        return view('exports.users', $data);
    }
}
