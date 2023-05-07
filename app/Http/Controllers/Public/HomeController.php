<?php
  
namespace App\Http\Controllers\Public;
  
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function showHomePage()
    {
        return view('public.pages.home.index');
    }

}