<?php
  
namespace App\Http\Controllers\Admin;
  
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getTimeLogging()
    {
        $from = Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->last_seen);
        $to = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $diff = $to->diffInMinutes($from);

        return response()->json(['time' => $diff]);
    }
}