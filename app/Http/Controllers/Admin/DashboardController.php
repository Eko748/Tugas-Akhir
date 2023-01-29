<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = ["parent" => "Dashboard", "child" => "Admin"];
        return view('admin.pages.dashboard.index', $data);
    }
}