<?php
  
namespace App\Http\Controllers\Dashboard;
  
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = ["parent" => "Dashboard", "child" => "Admin"];
        return view('pages.dashboard.index', $data);
    }
}